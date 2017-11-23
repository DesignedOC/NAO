CREATE TABLE IF NOT EXISTS `user` 
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log` varchar(100) NOT NULL,
  `mdp` varchar(100) NOT NULL,
  `isadmin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) 
ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

INSERT INTO `user` (`id`, `log`, `mdp`, `isadmin`) VALUES (1, 'admin', 'admin', 1);

CREATE TABLE IF NOT EXISTS `billet` 
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titre` longtext NOT NULL,
  `contenu` longtext NOT NULL,
  `dateajout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
)
ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

CREATE TABLE IF NOT EXISTS `commentaire` 
(
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contenu` longtext NOT NULL,
  `dateajout` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nbsignal` int(11) NOT NULL DEFAULT '0',
  `idbillet` int(11) NOT NULL,
  `iduser` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_COMMENTAIRE_BILLET` (`idbillet`)
)
ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=55 ;




