--Apenas exportei o BD pela própria funcionalidade do phpMyAdmin

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/10/2024 às 01:55
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bookoteca`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `release_date` date NOT NULL,
  `summary` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `genre`, `release_date`, `summary`, `image`, `users_id`) VALUES
(1, 'O Cortiço', 'Aluísio Azevedo', 'Romance', '1890-06-06', '“O Cortiço” é um romance escrito por Aluísio Azevedo que tem como cenário e personagem principal uma habitação coletiva de pessoas pobres. O autor conta sobre a rotina e as relações dos personagens que nela vivem, explicando seus comportamentos a partir das influências do meio-ambiente, da raça e do contexto histórico.', 'd6757c38c12a18b725cf323cc597d0eaa0e4874c41aa754a50491d68c44e5afb9c3de797171608d3843f2f3941b12bc19f2347efe86b70a4116019eb.jpg', 2),
(2, 'É Assim Que Acaba', 'Colleen Hoover', 'Romance', '2018-01-18', 'O romance mais pessoal da carreira de Colleen Hoover, É assim que acaba discute temas como violência doméstica e abuso psicológico de forma sensível e direta.\r\n\r\nEm É assim que acaba, Colleen Hoover nos apresenta Lily, uma jovem que se mudou de uma cidadezinha do Maine para Boston, se formou em marketing e abriu a própria floricultura. E é em um dos terraços de Boston que ela conhece Ryle, um neurocirurgião confiante, teimoso e talvez até um pouco arrogante, com uma grande aversão a relacionamentos, mas que se sente muito atraído por ela.', '6812baa2a04cfe5982a3c5f04305389f408323e75786ed135bee9c092974a97c354f536f3b15ee3a4f51b35877e6dbb90e9f0ee1fe980ebca17d4c8a.jpg', 2),
(3, 'Sapiens', 'Yuval Noah Harari', 'Ciência', '2015-01-01', 'O que possibilitou ao Homo sapiens subjugar as demais espécies? O que nos torna capazes das mais belas obras de arte, dos avanços científicos mais impensáveis e das mais horripilantes guerras? Nossa capacidade imaginativa. Somos a única espécie que acredita em coisas que não existem na natureza, como Estados, dinheiro e direitos humanos. Partindo dessa ideia, Yuval Noah Harari, doutor em história pela Universidade de Oxford, aborda em Sapiens a história da humanidade sob uma perspectiva inovadora. Explica que o capitalismo é a mais bem-sucedida religião, que o imperialismo é o sistema político mais lucrativo, que nós, humanos modernos, embora sejamos muito mais poderosos que nossos ancestrais, provavelmente não somos mais felizes. Um relato eletrizante sobre a aventura de nossa extraordinária espécie ? de primatas insignificantes a senhores do mundo.', NULL, 2),
(4, 'O fim do homem soviético', 'Svetlana Aleksiévitch', 'História', '2016-11-11', 'O povo russo assistiu com espanto à queda do Império Soviético. A política de abertura do governo Gorbatchóv impôs uma mudança drástica da estrutura social, do cotidiano e, sobretudo, da direção ideológica da população.\r\nEm O fim do homem soviético, Svetlana Aleksiévitch examina a vida das pessoas afetadas por essa transformação. Em cada personagem está um pouco da história russa — a mãe cuja filha morreu em um atentado; a antiga funcionária do Partido Comunista que coleciona carteiras abandonadas de ex-filiados; o velho militante que passou dez anos em um campo de trabalhos forçados.', NULL, 2),
(5, 'Não me abandone jamais', 'Kazuo Ishiguro', 'Ficção Científica', '2016-01-13', 'Kathy, Tommy e Ruth são clones criados para doar órgãos. Tendo esse cenário de ficção científica por pano de fundo, e o triângulo amoroso como gancho, o ganhador do prêmio Nobel de Literatura de 2017 fala de perda, de solidão e da sensação que às vezes temos de já ser \"tarde demais\".  Eleito um dos melhores livros do século XXI pelo The New York Times.', '341f681b876d7caa880a32102b1d580a64d15bd57c032700ccb2cce8a4270272f1713c22cd73402620c990e6838a163250246718e3073198894dd890.jpg', 1),
(6, 'Meio Sol Amarelo', 'Chimamanda Ngozi Adichie', 'História', '2017-04-26', 'Em meio à guerra fratricida que dividiu a Nigéria com a malograda tentativa de fundação do estado independente de Biafra, um grupo de pessoas busca provar a si mesmas e ao mundo que é capaz não só de sobreviver, mas também de resguardar seus sonhos e sua integridade moral. Garoto de aldeia, Ugwu procura se ajustar a uma realidade em rápida transformação. Olanna é uma moça da alta sociedade que se torna professora universitária e vive com Odenigbo, que abraça a causa revolucionária. Jornalista com ambição de se tornar escritor, Richard se apaixona pela irmã de Olanna, Kainene, figura esquiva, que reage com pragmatismo ao desmoronamento da nação. Baseado em fatos reais transcorridos na década de 1960, este romance da premiada escritora nigeriana Chimamanda Ngozi Adichie vai além do mero relato, transformando- se em um grandioso painel sobre indivíduos vivendo em tempos de exceção, um livro que a crítica internacional aproxima de V. S. Naipaul, Chinua Achebe e Nadine Gordimer.', NULL, 1),
(7, '1984', 'George Orwell', 'Ficção Científica', '1949-06-08', 'Uma distopia que explora um mundo totalitário e a opressão do governo.', '6607c6b526cd7101a371001dc1460b80e492316711271f694702cf28f16a2507649703729205908dd69f3012c3102a772488dc19881fc7040a5675bf.jpg', 1),
(8, 'Dom Casmurro', 'Machado de Assis', 'Romance', '1899-01-01', 'Um dos maiores clássicos da literatura brasileira, explorando ciúmes e traição.', NULL, 2),
(9, 'O Nome do Vento', 'Patrick Rothfuss', 'Fantasia', '2007-03-27', 'A história de Kvothe, um jovem talentoso e poderoso, contada em primeira pessoa.', NULL, 3),
(10, 'A Revolução dos Bichos', 'George Orwell', 'Fábula', '1945-08-17', 'Uma alegoria política criticando regimes totalitários.', NULL, 4),
(11, 'O Senhor dos Anéis', 'J.R.R. Tolkien', 'Fantasia', '1954-07-29', 'Uma épica aventura pela Terra-média em busca da destruição do Um Anel.', NULL, 5),
(12, 'Orgulho e Preconceito', 'Jane Austen', 'Romance', '1813-01-28', 'A história de Elizabeth Bennet, suas irmãs e os desafios do casamento no século XIX.', NULL, 6),
(13, 'Crime e Castigo', 'Fiódor Dostoiévski', 'Filosofia', '1866-12-25', 'Um mergulho psicológico nas consequências morais de um assassinato.', NULL, 1),
(14, 'O Pequeno Príncipe', 'Antoine de Saint-Exupéry', 'Infantil', '1943-04-06', 'Um conto filosófico sobre amor, amizade e perda.', NULL, 2),
(15, 'O Código Da Vinci', 'Dan Brown', 'Suspense', '2003-03-18', 'Um thriller que envolve conspirações religiosas e segredos históricos.', NULL, 3),
(16, 'Ensaio sobre a Cegueira', 'José Saramago', 'Ficção', '1995-10-15', 'Uma sociedade distópica em que todos ficam cegos, exceto uma mulher.', NULL, 4),
(17, 'O Hobbit', 'J.R.R. Tolkien', 'Fantasia', '1937-09-21', 'Bilbo Bolseiro embarca em uma aventura com anões em busca de um tesouro guardado por um dragão.', NULL, 5),
(18, 'A Menina que Roubava Livros', 'Markus Zusak', 'História', '2005-09-01', 'A emocionante história de uma menina durante a Segunda Guerra Mundial, narrada pela Morte.', '975f4153fb1e3d96e3729c5e262947e9d3fd13205827f00c1fdaba178d1ea2415f549bba354957f305adfada1d2bbde7c843302c6422bc18b7e4cee0.jpg', 6),
(19, 'A Guerra dos Tronos', 'George R.R. Martin', 'Fantasia', '1996-08-06', 'Intrigas políticas e batalhas épicas em Westeros.', NULL, 1),
(20, 'O Morro dos Ventos Uivantes', 'Emily Brontë', 'Romance', '1847-12-01', 'Uma intensa história de amor e vingança nos pântanos de Yorkshire.', NULL, 2),
(21, 'O Alquimista', 'Paulo Coelho', 'Ficção', '1988-04-01', 'A jornada de Santiago em busca de seu tesouro pessoal e da realização de seus sonhos.', NULL, 3),
(22, 'Cem Anos de Solidão', 'Gabriel García Márquez', 'Ficção', '1967-05-30', 'A saga de várias gerações da família Buendía, permeada por realismo mágico.', NULL, 4),
(23, 'Memórias Póstumas de Brás Cubas', 'Machado de Assis', 'Filosofia', '1881-03-15', 'Uma sátira social e filosófica narrada por um defunto autor.', NULL, 5),
(24, 'A Bússola de Ouro', 'Philip Pullman', 'Fantasia', '1995-07-10', 'Lyra Belacqua embarca em uma jornada para salvar seu mundo e descobrir a verdade sobre um misterioso pó.', NULL, 6),
(25, 'O Caçador de Pipas', 'Khaled Hosseini', 'Drama', '2003-05-29', 'Uma história de amizade, traição e redenção ambientada no Afeganistão.', NULL, 1),
(26, 'Drácula', 'Bram Stoker', 'Terror', '1897-05-26', 'O clássico romance gótico sobre o lendário vampiro Drácula e sua busca por novos territórios.', NULL, 2),
(28, 'Ayrton Senna', 'Christopher Hilton ', 'Biografia', '2009-07-31', '\"Ayrton Senna – Uma lenda a toda velocidade\" contém 13 luxuosos envelopes com réplicas de cartas escritas à mão, de agendas de corridas, de adesivos de escuderia autografados, entre outros itens especiais.\r\n\r\nNesta obra encontramos o Ayrton Senna que sempre será lembrado como lenda do automobilismo e grande ser humano, que sonhou criar oportunidades para crianças e jovens brasileiros. Assim nasceu o Instituto Ayrton Senna. Assim nasceu esta obra.', 'f8a3806a4c74b49f2b263ddcb00f2d61fb999eb0755daf6c47cfb666e8bebb2f048457b9c73f87a9c2828c28771b69bf174b05aa2f0a62056feec2d6.jpg', 9),
(29, 'Diário de um Banana', 'Jeff Kinneyy', 'Infantil', '2008-04-19', 'Não é fácil ser criança. E ninguém sabe disso melhor do que Greg Heffley, que se vê mergulhado no mundo do ensino fundamental, onde fracotes são obrigados a dividir os corredores com garotos mais altos, mais malvados e que já se barbeiam. Em Diário de um Banana, o autor e ilustrados Jeff Kinney nos apresenta um herói improvável. Como Greg diz em seu diário. Só não espere que seja todo Querido Diário isso, Querido Diário aquilo. Para nossa sorte, o que Greg Heffley diz que fará e o que ele realmente faz são duas coisas bem diferentes.', 'e2317a1cca4330991530b8672783a93378eb9566f0c48a78534f40a0972aaf610e7f58365c17536305e555ddbbb1a5a2280ae13650d950979f0635cc.jpg', 10);

-- --------------------------------------------------------

--
-- Estrutura para tabela `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `book_id`) VALUES
(6, 2, 4),
(10, 2, 1),
(12, 2, 19),
(13, 6, 6),
(14, 6, 8),
(15, 6, 3),
(16, 6, 18),
(17, 6, 23),
(18, 1, 2),
(19, 1, 7),
(20, 1, 17),
(21, 1, 23),
(23, 10, 2),
(24, 10, 3),
(25, 10, 18),
(26, 10, 23),
(27, 10, 29);

-- --------------------------------------------------------

--
-- Estrutura para tabela `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `review` text DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `books_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `reviews`
--

INSERT INTO `reviews` (`id`, `review`, `rating`, `books_id`, `users_id`, `created_at`) VALUES
(1, 'Bom', 7, 7, 2, '2024-10-10 11:14:11'),
(2, 'Não gostei do final.', 3, 6, 2, '2024-10-10 11:14:11'),
(3, 'Muito bom', 9, 28, 2, '2024-10-10 11:14:11'),
(4, 'Legal', 8, 28, 6, '2024-10-10 11:14:11'),
(5, 'Uma obra-prima da literatura brasileira, com uma crítica social impressionante.', 5, 1, 1, '2024-10-07 17:35:22'),
(6, 'Gostei muito da forma como Aluísio Azevedo retrata a vida no cortiço.', 4, 1, 2, '2024-10-08 12:15:45'),
(7, 'Um clássico que não perde sua relevância. Recomendo a todos.', 5, 1, 3, '2024-10-09 21:27:12'),
(8, 'Um livro poderoso, me tocou profundamente.', 5, 2, 4, '2024-10-07 19:45:10'),
(9, 'Colleen Hoover realmente sabe como capturar emoções intensas.', 4, 2, 5, '2024-10-08 15:30:55'),
(10, 'Uma história envolvente, mas o final foi um pouco previsível.', 3, 2, 6, '2024-10-09 14:25:33'),
(11, 'Uma leitura indispensável para entender a história da humanidade.', 5, 3, 1, '2024-10-07 13:05:42'),
(12, 'Fantástico! Harari tem uma forma única de explicar nossa evolução.', 5, 3, 2, '2024-10-08 11:22:11'),
(13, 'Achei interessante, mas em alguns momentos o autor simplifica demais.', 3, 3, 3, '2024-10-09 23:15:57'),
(14, 'Um relato impressionante sobre a queda de um império.', 4, 4, 4, '2024-10-07 17:01:32'),
(15, 'Svetlana tem uma maneira única de contar histórias pessoais em meio à história política.', 5, 4, 5, '2024-10-08 22:47:24'),
(16, 'Um livro forte e tocante. Leitura essencial para entender a Rússia moderna.', 5, 4, 6, '2024-10-09 20:34:55'),
(17, 'Uma obra perturbadora, mas incrivelmente bem escrita.', 5, 5, 1, '2024-10-07 16:50:18'),
(18, 'Ficção científica com profundidade emocional. Muito bom!', 4, 5, 2, '2024-10-09 00:33:44'),
(19, 'A premissa do livro é fascinante, mas senti falta de mais ação.', 3, 5, 3, '2024-10-09 18:09:12'),
(20, 'Chimamanda nunca decepciona! Um relato intenso sobre a guerra na Nigéria.', 5, 6, 4, '2024-10-07 12:38:27'),
(21, 'A narrativa é excelente, mas achei o ritmo um pouco lento em algumas partes.', 4, 6, 5, '2024-10-08 14:59:05'),
(22, 'Um livro poderoso, com personagens muito bem construídos.', 5, 6, 6, '2024-10-10 01:05:41'),
(23, 'Uma distopia assustadoramente atual.', 5, 7, 1, '2024-10-07 21:24:36'),
(24, 'Orwell criou um mundo que parece cada vez mais real.', 5, 7, 2, '2024-10-08 17:16:50'),
(25, 'Uma leitura densa, mas vale muito a pena pela reflexão que provoca.', 4, 7, 3, '2024-10-09 16:40:19'),
(26, 'Um clássico que explora a complexidade das relações humanas.', 5, 8, 4, '2024-10-07 13:50:11'),
(27, 'Machado de Assis é um gênio! A narrativa é envolvente.', 5, 8, 5, '2024-10-08 18:22:38'),
(28, 'A interpretação do passado é fascinante, mas o ritmo é lento.', 3, 8, 6, '2024-10-09 22:30:04'),
(29, 'Uma narrativa envolvente que prende o leitor do início ao fim.', 5, 9, 1, '2024-10-07 14:12:45'),
(30, 'Adorei a construção do mundo e dos personagens.', 5, 9, 2, '2024-10-08 23:00:11'),
(31, 'A história é incrível, mas alguns trechos são longos demais.', 4, 9, 3, '2024-10-09 20:18:20'),
(32, 'Uma crítica política muito bem elaborada.', 5, 10, 4, '2024-10-07 16:10:22'),
(33, 'Uma alegoria que continua relevante nos dias de hoje.', 5, 10, 5, '2024-10-08 17:55:11'),
(34, 'Um livro que todo mundo deveria ler!', 4, 10, 6, '2024-10-09 19:37:45'),
(35, 'Uma obra épica que define o gênero de fantasia.', 5, 11, 1, '2024-10-07 18:42:33'),
(36, 'A aventura de Frodo e seus amigos é emocionante.', 5, 11, 2, '2024-10-08 22:12:57'),
(37, 'Adoro o mundo que Tolkien criou, mas a leitura pode ser densa.', 4, 11, 3, '2024-10-09 14:48:39'),
(38, 'Uma história atemporal sobre amor e classe.', 5, 12, 4, '2024-10-07 13:24:16'),
(39, 'A escrita de Jane Austen é simplesmente magnífica.', 5, 12, 5, '2024-10-08 15:45:50'),
(40, 'Os diálogos são inteligentes, mas algumas partes são um pouco lentas.', 3, 12, 6, '2024-10-09 16:32:18');

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `status` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`id`, `name`, `lastname`, `email`, `password`, `image`, `token`, `bio`, `status`) VALUES
(1, 'João', 'Lima', 'joao@gmail.com', '$2y$10$/qsrcDyzK1jifkYdJ4rjd.eavuaHk9Qyw8YgdSg8obwM7bnjD1sNi', '0144cd308748393c5115d7c1bd48498c5d8ca4a9ba0000b06b6449b332d6e789c54345eb0a9f68e74c4adf8c5a10bfb7d605559adf1b47cf5acf6934.jpg', '20ca62650fb0ebe3eb6321198293be89e13e2ac97b85718f6080f2a9d79ebeb9d4cd3c1074d385170c6123afac9429db04ac', '', 1),
(2, 'Lucas', 'Ferreira', 'lucas@gmail.com', '$2y$10$ftC2n9NskJZUZzS./La8s.B6fwFE1r3gcjQrLFkaqEUSuqRwygA8q', '1f0d5656da2b14cd19adeebc64f0cb89dfda1b2d372a9179e851e935a082f17b70b7a055cb067fd3dea53ea8b6c76dfa7601ef14f7ac2953cc100c90.jpg', 'ead64d95be02a05b82ab22b5921fba3b38ea8bd59ac1eed79eea8f616771f967e31cfd11ca8e660d2fb8348b13862d50884d', 'Sou Lucas, tenho 27 anos e gosto de ler romance.', 1),
(3, 'Miguel', 'Lima', 'miguel@gmail.com', '$2y$10$l7ls3M67TTLTNR7g9919puhYjL62Tqx.D8d.iicOaGvtay12Md8OG', NULL, '4dbd66af405f8bc1867e2ee7ddeb70a5b0046209d1264f271d14fe3a6b7137a15a43cee21b68ea422ed85f6e4b6d10191440', NULL, 1),
(4, 'Jó', 'Ferreira', 'jo@gmail.com', '$2y$10$7TOUtTM8BvpUeIHs7.jnC.1Mj4Qvjxc3.QUvE07m0IOSDw982DKpW', NULL, 'c580dd34aaf96a1f35814cb9648aa23b423fb315014f913a9428cc597f82ee4098b80ccb8e3a54cac5b84e3f7d3e42b4f876', NULL, 1),
(5, 'Paulo', 'Ferreira', 'paulo@gmail.com', '$2y$10$xxVRH.uRkGXGHKlp1vjw0eY37KoG.OvDX1YoQ3EWPGN1/ppzRn7Du', NULL, 'b327daad9e8f318148169aaafc3b70df67880611ed6bdf33d8380a489dd631885dbc7fc6a8ba0d628d912afb672331cbdd7c', NULL, 1),
(6, 'Yasmim', 'Ferreira', 'yasmim@gmail.com', '$2y$10$gecnTsX/BaI9WtZ0wBuvL.kwqP7xOKOLxjbIoXA2sC9VcgKWexPMK', NULL, '8f1127a5cc176321c33e05e4858d4b177a86dd08749ab196c55b049fa6d408ebf9a5cbc164bce4b59a9b2ca631b54945878a', NULL, 1),
(9, 'Cristiano', 'Ferreira', 'cristiano@hotmail.com', '$2y$10$YDwNHnMmlX/C.ANWM47HdeahDBdEERiiSNnd248hvgItxS0/3WMY6', NULL, 'ffcb9cd60d910318ef412108e757a7083f8d2865d2c64e264ba9b452189541f3637f0c71dd982a2fc1315e6c4f3ce9226799', NULL, 1),
(10, 'Administrador', '1', 'adm', '$2y$10$6dub8FflZE2PxLK3dWm3pOcBLDK9ZVt8yK8kASFm2lXQAkwrOJgjO', NULL, 'eeb850c5d2680ab56b430e970c4cf4fea1cd5db5374f7a4c0cfdf9109081cdae461e3a168cfc24b95e1335551d5c5103eeb9', NULL, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_id` (`users_id`);

--
-- Índices de tabela `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Índices de tabela `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `book_id` (`books_id`),
  ADD KEY `user_id` (`users_id`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Restrições para tabelas `favorites`
--
ALTER TABLE `favorites`
  ADD CONSTRAINT `favorites_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `favorites_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`books_id`) REFERENCES `books` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
