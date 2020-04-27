CREATE TABLE IF NOT EXISTS `PREFIX_da_test`
(
    `id`   INT(11)     NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(32) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = _ENGINE_
  DEFAULT CHARSET = utf8
  AUTO_INCREMENT = 1;

INSERT INTO `PREFIX_da_test`
VALUES (NULL, 'test #1'),
       (NULL, 'test #2'),
       (NULL, 'test #3'),
       (NULL, 'test #4'),
       (NULL, 'test #5');
