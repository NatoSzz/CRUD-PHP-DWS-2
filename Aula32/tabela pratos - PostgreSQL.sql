CREATE TABLE pratos
(
    id          serial NOT NULL,
    nome        character varying(150) NOT NULL,
    preco       NUMERIC(10, 2)         NOT NULL,
    urlfoto     character varying(350) NOT NULL,
    descricao   TEXT                   NULL,  
    CONSTRAINT  pratos_pkey PRIMARY KEY (id)
)
WITH (
    OIDS = FALSE
)
TABLESPACE pg_default;

INSERT INTO pratos(nome, preco, urlfoto, descricao) 
    VALUES ('Feijoada',54.90, 'https://p2.trrsf.com/image/fget/cf/774/0/images.terra.com/2024/04/18/1061153462-feijoada-de-ogum.jpg','A combinação de feijão preto e carnes de porco é sucesso nos restaurantes de todo o país e, geralmente, vem acompanhada por arroz, farofa, couve e torresmo.');

INSERT INTO pratos(nome, preco, urlfoto, descricao) 
    VALUES ('Lasanha',39.90, 'https://vitarella.com.br/wp-content/uploads/2020/12/08_LASANHA_FINAL-1-min.jpg','Camadas delicadas de massa intercaladas com molho artesanal, queijo derretido e um toque de tradição em cada mordida.');    

INSERT INTO pratos(nome, preco, urlfoto, descricao) 
    VALUES ('Brigadeiro',16.90, 'https://i0.wp.com/www.flamboesa.com.br/wp-content/uploads/2015/02/DSC00951.jpg?fit=4809%2C3195&ssl=1','Clássico doce brasileiro, feito com leite condensado e chocolate, enrolado com carinho e coberto por granulados crocantes');    

INSERT INTO pratos(nome, preco, urlfoto, descricao) 
    VALUES ('Rabanada',24.50, 'https://s2-receitas.glbimg.com/-2g59NlShfa-LLB8esAeSgYQTKQ=/0x0:1600x1200/984x0/smart/filters:strip_icc()/s.glbimg.com/po/rc/media/2015/11/03/15_52_46_241_DSCN8283.JPG','Fatias de pão embebidas em leite e ovos, fritas até dourar e polvilhadas com açúcar e canela. Um doce tradicional!');    

INSERT INTO pratos(nome, preco, urlfoto, descricao) 
    VALUES ('Bolo de cenoura',33.90, 'https://cloudfront-us-east-1.images.arcpublishing.com/estadao/THUHXGIGTBLOTH64QNZ3OJ5Z64.jpg','Bolo fofinho de cenoura coberto com uma deliciosa calda de chocolate, perfeito para o lanche ou sobremesa.');    

INSERT INTO pratos(nome, preco, urlfoto, descricao) 
    VALUES ('Mousse de limão',29.90, 'https://i.ytimg.com/vi/mzn3B_eArQk/maxresdefault.jpg','Sobremesa leve e refrescante, feita com limão, creme e açúcar, que derrete na boca. Um toque cítrico irresistível!');    

INSERT INTO pratos(nome, preco, urlfoto, descricao) 
    VALUES ('Panqueca americana',12.20, 'https://www.restodonte.com.br/recipePics/9900828.jpg?v114','APanquecas altas e macias, servidas com maple syrup ou frutas, ideais para um café da manhã delicioso e farto.');    