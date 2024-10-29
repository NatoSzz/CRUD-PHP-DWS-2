CREATE TABLE pratos
(
    id           INT             NOT NULL    AUTO_INCREMENT,
    nome         VARCHAR(150)    NOT NULL,
    preco        NUMERIC(10, 2)  NOT NULL,   
    urlfoto      VARCHAR(350)    NULL,    
    descricao    TEXT            NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB;

INSERT INTO pratos(nome, preco, urlfoto, descricao) 
    VALUES ('Feijoada',54.90, 'https://p2.trrsf.com/image/fget/cf/774/0/images.terra.com/2024/04/18/1061153462-feijoada-de-ogum.jpg','A combinação de feijão preto e carnes de porco é sucesso nos restaurantes de todo o país e, geralmente, vem acompanhada por arroz, farofa, couve e torresmo.');

INSERT INTO pratos(nome, preco, urlfoto, descricao) 
    VALUES ('Lasanha',39.90, 'https://vitarella.com.br/wp-content/uploads/2020/12/08_LASANHA_FINAL-1-min.jpg','Camadas delicadas de massa intercaladas com molho artesanal, queijo derretido e um toque de tradição em cada mordida.');    

INSERT INTO pratos(nome, preco, urlfoto, descricao) 
    VALUES ('Brigadeiro',16.90, 'https://i0.wp.com/www.flamboesa.com.br/wp-content/uploads/2015/02/DSC00951.jpg?fit=4809%2C3195&ssl=1','Clássico doce brasileiro, feito com leite condensado e chocolate, enrolado com carinho e coberto por granulados crocantes');    