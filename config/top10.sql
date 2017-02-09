CREATE TABLE IF NOT EXISTS `top10connections` (
`id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `connections` int(11) NOT NULL,
  `nick` text NOT NULL,
  `clid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `top10connectiontime` (
`id` int(11) NOT NULL,
  `uid` text NOT NULL,
  `connectiontime` int(11) NOT NULL,
  `nick` text NOT NULL,
  `clid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

ALTER TABLE `top10connections` ADD PRIMARY KEY (`id`);

ALTER TABLE `top10connectiontime` ADD PRIMARY KEY (`id`);

ALTER TABLE `top10connections` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;

ALTER TABLE `top10connectiontime` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;