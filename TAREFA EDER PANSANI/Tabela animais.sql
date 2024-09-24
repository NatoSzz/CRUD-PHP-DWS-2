CREATE TABLE Animais (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    peso INT NOT NULL,
    imagem VARCHAR(255) NOT NULL
);

-- Inserindo dados na tabela Animais
INSERT INTO Animais (nome, peso, imagem)
VALUES 
('Leão', 190, 'https://xamanismoflorescer.com.br/wp-content/uploads/2023/06/leao-animal-de-poder.jpg'),
('Elefante', 5000, 'https://pensamentoverde.com.br/wp-content/uploads/2015/08/maternidade-elefantes.jpg');