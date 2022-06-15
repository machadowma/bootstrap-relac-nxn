create database relacnxn;
use relacnxn;
drop table if exists livro_autor;
drop table if exists autor;
drop table if exists livro;

create table autor (
    id integer auto_increment primary key
    , nome varchar(50)
);

create table livro (
    id integer auto_increment primary key
    , nome varchar(50)
);

create table livro_autor (
    id_livro integer not null
    , id_autor integer not null
    ,primary key(id_livro, id_autor)
    , foreign key(id_livro) references livro(id) on delete cascade
    , foreign key(id_autor) references autor(id) on delete cascade
);

-- INSERINDO DADOS DE EXEMPLO

INSERT INTO autor (nome) VALUES 
  ('Andrew S. Tanenbaum')
 ,('Maarten V. Steen')
 ,('J. R. R. Tolkien');

INSERT INTO livro (nome) VALUES 
  ('Sistemas Distribuídos')
 ,('Sistemas Operacionais Modernos')
 ,('O Senhor dos Anéis');


INSERT INTO livro_autor(id_livro,id_autor) VALUES ( 
 (select id from livro where nome = 'O Senhor dos Anéis') 
,(select id from autor where nome = 'J. R. R. Tolkien') 
);

INSERT INTO livro_autor(id_livro,id_autor) VALUES ( 
 (select id from livro where nome = 'Sistemas Distribuídos') 
,(select id from autor where nome = 'Andrew S. Tanenbaum') 
);

INSERT INTO livro_autor(id_livro,id_autor) VALUES ( 
 (select id from livro where nome = 'Sistemas Distribuídos') 
,(select id from autor where nome = 'Maarten V. Steen') 
);


INSERT INTO livro_autor(id_livro,id_autor) VALUES ( 
 (select id from livro where nome = 'Sistemas Operacionais Modernos') 
,(select id from autor where nome = 'Andrew S. Tanenbaum') 
);



