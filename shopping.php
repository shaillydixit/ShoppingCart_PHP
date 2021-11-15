SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT=0;
START TRANSACTION;
SET time_zome="+00:00";

CREATE TABLE 'tbl_product'(
    'id'int(11) NOT NULL,
    'name' varchar(255) NOT NULL,
    'image' varchar(255) NOT NULL,
    'price' double(10,2) NOT NULL
) ENGINE= MyISAM DEFAULT CHARSET=latin1;

INSERT INTO `tbl_product`(`id`, `name`, `image`, `price`) VALUES 
(3, 'men shoes', 'xyz.jpg',200.65),
(4, 'men shirt', 'xyz.jpg',245.65),
(5, 'men tshirt', 'xyz.jpg',277.65);

ALTER TABLE `tbl_product`
ADD PRIMARY KEY(`id`);

ALTER TABLE `tbl_product`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
COMMIT;
