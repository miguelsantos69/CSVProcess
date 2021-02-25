CSVExport
=========

Aplikacja korzysta z [CSVLeague](https://csv.thephpleague.com/) oraz z [KNPPaginatorBundle](https://github.com/KnpLabs/KnpPaginatorBundle)

### Konfigurowanie bazy danych

W celu skonfigurowania bazy danych należy ustawić nazwę bazy oraz jej hasło w katalogu: 
`app/config/parameters.yml`

    parameters:
        database_host:     nazwa_hosta
        database_name:     nazwa_bazy
        database_user:     nazwa_usera
        database_password: hasło

Następnie w konsoli zatwierdzić zmiany poprzez
`php bin/console doctrine:database:create`

Polecenie utworzenia tabeli Produkty:

    CREATE TABLE `nazwa_bazy`.`Produkty` 
    ( `id` INT NOT NULL AUTO_INCREMENT , `kodProduktu` INT NOT NULL ,
     `ilosc` INT NOT NULL , `rokProdukcji` INT NOT NULL , 
    `cena` FLOAT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

Tabeli Historia:

    CREATE TABLE `nazwa_bazy`.`Historia` ( `id` INT NOT NULL AUTO_INCREMENT , 
    `pliki` INT NOT NULL , `ostatniImport` DATETIME NOT NULL , 
    PRIMARY KEY (`id`)) ENGINE = InnoDB;

### Użytkowanie
Po wywołaniu konsoli w miejscu, w którym znajduje się aplikacja, należy za pomocą polecenia 

`php bin\console CSVimport lokalizacja_pliku`

zaimportować wybrany plik CSV. 

Rekordy które nie przeszły procesu walidacji zapisywane są w folderze `AppBundle\Odrzucone`

### Możliwe komunikaty
PHP Memory Limit Error - należy zwiększyć [limit pamięci w pliku php.ini](https://haydenjames.io/understanding-php-memory_limit/)
