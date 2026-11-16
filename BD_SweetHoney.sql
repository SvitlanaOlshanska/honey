
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";



CREATE TABLE `cart` (
  `id_cart` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_prodotto` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
  
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




CREATE TABLE `prodotti` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `price` double(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL

) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `prodotti` (`id`, `name`, `description`,`price`,`image`) VALUES
(5, 'Miele di Acacia', '  Il miele di acacia e\' di color giallo molto chiaro, trasparente e di consistenza liquida. \r\n  Il gusto e\' ovviamente dolce, con retrogusto vagamente amarognolo, quasi impercettibile.\r\n   Aroma e sapore sono delicati, di fiori, di vaniglia e del tutto caratteristici. \r\n  Se purissimo, ovvero non miscelato con altre sorgenti floreali, e\' quasi del tutto incolore. ', 5.30, 'assets/img/acaccia.jpg'),
(6, 'Miele di Eucalipto', '  Miele di colore ambra chiaro e dal sapore aromatico caratteristico.\nHa una cristallizzazione rapida e compatta a grana fine. \nIl miele di eucalipto viene utilizzato principalmente contro la tosse e le malattie tipiche dell apparato respiratorio come il raffreddore, \noltre che in generale per i malesseri dovuti a stati di infiammazione.\n In cucina invece, come miele da tavola per l accompagnamento dei formaggi.', 6.80, 'assets/img/eucalipto.jpg'),
(8, 'Miele di Melata', '  Miele di colore scuro (marrone-nero) e dal sapore gradevole, anche se meno dolce rispetto ai mieli di nettare.\r\nHa una cristallizzazione lenta e irregolare a grana grossa.\r\nRecenti ricerche hanno confermato le proprieta\' antibatteriche del miele nei confronti di vari microbi e \r\nin particolare si e\' riscontrato che la varieta\' di miele di castagno, eucalipto e melata di abete, \r\nsono piu\' efficaci nel combattere i batteri patogeni come Staphylococcus aureus, spesso resistente agli antibiotici.\r\n  Le caratteristiche particolari del miele di melata lo consigliano come un alimento antibiotico al 100% naturale da avere sempre in casa.', 6.45, 'assets/img/melata.jpg'),
(9, 'Miele di Girasole', '  Miele di colore giallo oro e dal sapore delicato. Ha una cristallizzazione rapida e compatta a grana media.\r\n   Una delle proprieta\' curative piu\' conosciute del miele di girasole e\' la sua capacita\' di rimineralizzazione. Si tratta di un vero e proprio \r\n integratore naturale di sali minerali, soprattutto calcio e magnesio, utili a prevenire l\'indebolimento delle strutture ossee, \r\n in particolare nelle persone che presentano fattori di rischio per l\'osteoporosi, come le donne in menopausa e gli anziani.\r\n  A tavola viene accompagnato dai formaggi e come ingrediente in pasticceria o nell industria alimentare.', 3.90, 'assets/img/girasole.png'),
(10, 'Miele di Castagno', '  Miele di colore ambra (chiaro o scuro) e dal sapore leggermente amaro.\r\n  Ha una cristallizzazione quasi assente e, percio\', mantiene una consistenza liquida per lungo tempo.\r\n  Il miele di castagno e\' un\'ottima fonte di proteine, vitamine B e C e di sali minerali, quali manganese, potassio, \r\n  calcio e in particolare ferro. Come tutti i mieli, anche quello di castagno e\' molto calorico, 100 grammi apportano 300 calorie e \r\n  quindi si consiglia di consumarlo in modeste quantita\'. ', 8.50, 'assets/img/castagno.jpg'),
(11, 'Miele di Tiglio', ' Miele di colore giallo chiaro e dal sapore aromatico caratteristico.\r\n Ha una cristallizzazione lenta e compatta a grana fine.\r\n Antispasmodico, rilassante, calmante\r\n Il miele di tiglio funziona come calmante. Dai fiori deriva la sua caratteristica principale: quella rilassante.\r\n  Questa proprieta\' e\' nota da sempre nell uso popolare.', 10.00, 'assets/img/tiglio.jpg'),
(12, 'Miele di Lavanda', 'La colorazione di questo miele varia: si presenta in forma liquida di colore dal giallo al beige e successivamente \r\n  ha una cristallizzazione di cristalli di media e piccola misura, e il colore diventa da chiaro ad ambrato.\r\n    Il profumo e\' fragrante, tipico delle piante aromatiche ricche di oli essenziali.\r\n	 Il suo sapore ricorda i frutti del fico e della passiflora oltre al tipico sapore della lavanda stessa.\r\n  Il miele di lavanda prende le sue proprieta\' dalla stessa pianta di lavanda e quindi risulta ottimo come calmante del sistema nervoso:\r\n   placa la tensione sia a livello fisico che psichico ed emotivo perche\' capace di distendere e rilassare.\r\n   Utilizzato anche per calmare il mal di testa provocato da tensione e stress che viene accumulato durante la giornata, e\' ottimo in caso di vertigini, per l\'ansia e per l\'insonnia,\r\n    per lenire le infiammazioni dell apparato respiratorio, per calmare la tosse e aiutare le corde vocali.Viene anche consigliato come analgesico, antireumatico e per l\'apparato gastrointestinale e\' un antispasmodico con azione digestiva.', 12.50, 'assets/img/lavanda.jpg');

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






CREATE TABLE `user_profile` (
  `id_user` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `indirizzo` varchar(255) DEFAULT NULL,
  `tel` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;






ALTER TABLE `cart`
  ADD PRIMARY KEY (`id_cart`),
  ADD KEY `cart_prodotto` (`id_prodotto`);
 
 


ALTER TABLE `prodotti`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`,`email`) USING HASH,
ADD UNIQUE KEY( `email`);

ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `unique_tel` (`tel`);

ALTER TABLE `cart`
MODIFY `id_cart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
ALTER TABLE `prodotti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;


ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;


ALTER TABLE `cart`
  ADD CONSTRAINT `cart_prodotto` FOREIGN KEY (`id_prodotto`) REFERENCES `prodotti` (`id`)ON DELETE CASCADE  ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;


ALTER TABLE `user_profile`
  ADD CONSTRAINT `profile_user` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;