<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Entity\Produkty;
use League\Csv\Reader;
use League\Csv\Writer;
use Symfony\Component\Console\Style\SymfonyStyle;
use AppBundle\Entity\Historia;


class CSVExport extends ContainerAwareCommand {

    public function __construct(EntityManagerInterface $em) {

        parent::__construct();

        $this->em = $em;
    }

    public function configure() {
        $this
                ->setName('CSVImport')
                ->setDescription('Importuje plik CSV do bazy danych')
                ->addArgument('lokalizacja', InputArgument::REQUIRED, 'Lokalizacja pliku')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $io = new SymfonyStyle($input, $output);
        $io->title('Próba importu pliku...');

        $reader = Reader::createFromPath($input->getArgument('lokalizacja'));
        $reader->setDelimiter(';');
        $reader->setHeaderOffset(0);

        $results = $reader->getRecords();
        
        $io->progressStart(iterator_count($results));

        $pliki = iterator_count($results);
        $date = date('Y-d-m H.i.s');
        $hour = date('d_m_Y-H_i_s');

        $writer = Writer::createFromPath('%kernel.root_dir%/../src/AppBundle/Odrzucone/odrzucone' . $hour . '.csv', 'w+');

        foreach ($results as $row) {

            // Zmienna do walidacji kolumny 'description'
            $rok = $row['description'];

            $isValid = false;

            if ($row['qty'] > 0 && $row['price'] > 0 && !empty($row['mpn'])) {

                $isValid = true;

                $rok = filter_var($row['description'], FILTER_SANITIZE_NUMBER_INT);

                $produkt = (new Produkty())
                        ->setKodProduktu($row['mpn'])
                        ->setIlosc($row['qty'])
                        ->setRokProdukcji($rok)
                        ->setCena($row['price']);

                $this->em->persist($produkt);
             
                $io->progressAdvance();
            } 
            if ($row['qty'] == 0 || $row['price'] == 0 || empty($row['mpn'])) {

                $writer->insertOne([$row['offer_id'],
                    $row['mpn'],
                    $row['name'],
                    $row['producer'],
                    $row['price'],
                    $row['seller'],
                    $row['qty'],
                    $row['qty'],
                    $row['description']]
                );
                continue;
            }
        }
        
        $io->progressFinish();

        $historia = (new Historia())->setPliki($pliki);
        $this->em->persist($historia);
        
        $this->em->flush();

        $io->success('Import zakonczony sukcesem w dniu ' . $date);
    }
    
}
