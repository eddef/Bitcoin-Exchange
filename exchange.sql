-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2016 at 10:22 PM
-- Server version: 10.1.19-MariaDB
-- PHP Version: 7.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `exchange`
--

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` int(11) NOT NULL,
  `address` text NOT NULL,
  `coin` text NOT NULL,
  `username` text NOT NULL,
  `date` datetime NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `api`
--

CREATE TABLE `api` (
  `api_id` int(11) NOT NULL,
  `api_name` text NOT NULL,
  `api_pubkey` text NOT NULL,
  `api_secret` text NOT NULL,
  `api_date` date NOT NULL,
  `api_user` text NOT NULL,
  `api_perms` varchar(10) NOT NULL,
  `api_nonce` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `banlist`
--

CREATE TABLE `banlist` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `bannedby` text NOT NULL,
  `banneduntil` date NOT NULL,
  `reason` text NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `coins`
--

CREATE TABLE `coins` (
  `coin_id` int(11) NOT NULL,
  `coin_coin` text NOT NULL,
  `coin_description` text NOT NULL,
  `coin_title` text NOT NULL,
  `coin_market` int(11) NOT NULL,
  `coin_enabled` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emailactivate`
--

CREATE TABLE `emailactivate` (
  `id` int(11) NOT NULL,
  `email` text NOT NULL,
  `code` text NOT NULL,
  `date` date NOT NULL,
  `renewed` int(11) NOT NULL,
  `complete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `faq` text NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `identifications`
--

CREATE TABLE `identifications` (
  `id` int(11) NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `image` text NOT NULL,
  `firstname` text NOT NULL,
  `lastname` text NOT NULL,
  `address1` text NOT NULL,
  `address2` text NOT NULL,
  `city` text NOT NULL,
  `postcode` text NOT NULL,
  `state` text NOT NULL,
  `dateofbirth` text NOT NULL,
  `ip` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `login_id` int(11) NOT NULL,
  `login_email` text NOT NULL,
  `login_ip` text NOT NULL,
  `login_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `login_status` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logins`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `message` text NOT NULL,
  `user` text NOT NULL,
  `messageread` varchar(10) NOT NULL DEFAULT 'unread',
  `whofrom` text NOT NULL,
  `type` text NOT NULL,
  `date` datetime NOT NULL,
  `tempdelete` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `page` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_amount` text NOT NULL,
  `order_market` varchar(25) NOT NULL,
  `order_fee` varchar(25) NOT NULL,
  `order_cost` varchar(25) NOT NULL,
  `order_time` datetime NOT NULL,
  `order_user` varchar(25) NOT NULL,
  `order_ip` varchar(25) NOT NULL,
  `order_price` text NOT NULL,
  `order_beforefee` text NOT NULL,
  `order_buysell` varchar(10) NOT NULL,
  `order_maincoin` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `url` text NOT NULL,
  `body` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `referal`
--

CREATE TABLE `referal` (
  `id` int(11) NOT NULL,
  `market` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `tfhour` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `tdays` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `summary` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `user` varchar(250) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sitename` varchar(25) NOT NULL,
  `slogan` text NOT NULL,
  `siteurl` varchar(25) NOT NULL,
  `keywords` varchar(250) NOT NULL,
  `description` varchar(250) NOT NULL,
  `coins` varchar(250) NOT NULL,
  `fees` varchar(10) NOT NULL,
  `vat` text NOT NULL,
  `address` text NOT NULL,
  `phonenumber` text NOT NULL,
  `email` text NOT NULL,
  `emailverify` int(11) NOT NULL,
  `userverify` int(11) NOT NULL,
  `maintenance` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `support`
--

CREATE TABLE `support` (
  `id` int(11) NOT NULL,
  `user` text COLLATE utf8_unicode_ci NOT NULL,
  `category` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `ipaddress` int(11) NOT NULL,
  `priority` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  `status` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `message` text COLLATE utf8_unicode_ci,
  `user` varchar(250) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `mainticket` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trades`
--

CREATE TABLE `trades` (
  `trade_id` int(11) NOT NULL,
  `trade_amount` text NOT NULL,
  `trade_market` varchar(25) NOT NULL,
  `trade_cost` varchar(25) NOT NULL,
  `trade_fee` varchar(25) NOT NULL,
  `trade_time` time NOT NULL,
  `trade_user` varchar(25) NOT NULL,
  `trade_ip` varchar(25) NOT NULL,
  `trade_price` text NOT NULL,
  `trade_buysell` text NOT NULL,
  `trade_date` datetime NOT NULL,
  `trade_maincoin` text NOT NULL,
  `trade_charttime` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `transaction_address` text COLLATE utf8_unicode_ci NOT NULL,
  `transaction_firstname` text COLLATE utf8_unicode_ci NOT NULL,
  `transaction_lastname` text COLLATE utf8_unicode_ci NOT NULL,
  `transaction_email` text COLLATE utf8_unicode_ci NOT NULL,
  `transaction_country` text COLLATE utf8_unicode_ci NOT NULL,
  `transaction_state` text COLLATE utf8_unicode_ci NOT NULL,
  `transaction_street` text COLLATE utf8_unicode_ci NOT NULL,
  `transaction_phone` text COLLATE utf8_unicode_ci NOT NULL,
  `transaction_user` text COLLATE utf8_unicode_ci NOT NULL,
  `transaction_confirmations` int(11) NOT NULL,
  `transaction_txid` text COLLATE utf8_unicode_ci NOT NULL,
  `transaction_amount` text COLLATE utf8_unicode_ci NOT NULL,
  `transaction_market` text COLLATE utf8_unicode_ci NOT NULL,
  `transaction_date` datetime NOT NULL,
  `transaction_time` text COLLATE utf8_unicode_ci NOT NULL,
  `transaction_transaction` text COLLATE utf8_unicode_ci NOT NULL,
  `transaction_status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userguides`
--

CREATE TABLE `userguides` (
  `id` int(11) NOT NULL,
  `title` text NOT NULL,
  `message` text NOT NULL,
  `date` int(11) NOT NULL,
  `url` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` bigint(11) NOT NULL,
  `user_ip_address` text NOT NULL,
  `user_username` varchar(25) NOT NULL,
  `user_email` varbinary(100) NOT NULL,
  `user_password` text NOT NULL,
  `user_passwordsalt` text NOT NULL,
  `user_admin` int(11) NOT NULL DEFAULT '0',
  `user_staff` int(11) NOT NULL DEFAULT '0',
  `user_nofees` int(11) NOT NULL DEFAULT '0',
  `user_btc` decimal(10,4) DEFAULT '0.0000',
  `user_ltc` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `user_usd` decimal(10,2) NOT NULL DEFAULT '0.00',
  `user_gbp` decimal(10,2) NOT NULL DEFAULT '0.00',
  `user_eur` decimal(10,2) NOT NULL DEFAULT '0.00',
  `user_firstname` varbinary(100) DEFAULT NULL,
  `user_lastname` varbinary(100) DEFAULT NULL,
  `user_address1` varbinary(100) DEFAULT NULL,
  `user_address2` varbinary(100) DEFAULT NULL,
  `user_city` varbinary(100) DEFAULT NULL,
  `user_zip` varbinary(100) DEFAULT NULL,
  `user_state` varbinary(100) DEFAULT NULL,
  `user_country` varbinary(100) DEFAULT NULL,
  `user_dob` varbinary(100) DEFAULT NULL,
  `user_security_question2` varbinary(100) NOT NULL,
  `user_security_answer1` varbinary(100) NOT NULL,
  `user_security_question1` varbinary(100) NOT NULL,
  `user_security_answer2` varbinary(100) NOT NULL DEFAULT 'english',
  `user_emailverified` int(11) NOT NULL DEFAULT '0',
  `user_email_code` varchar(250) NOT NULL,
  `user_detailverified` int(11) NOT NULL DEFAULT '0',
  `user_detailssubmitted` int(11) NOT NULL DEFAULT '0',
  `user_invalidid` int(11) NOT NULL,
  `user_verifyimg` text NOT NULL,
  `user_ipwhitelist` text NOT NULL,
  `user_banned` int(11) NOT NULL DEFAULT '0',
  `user_messagenotify` int(11) NOT NULL DEFAULT '1',
  `user_sidebaropen` int(11) NOT NULL DEFAULT '0',
  `user_chatbaropen` int(11) NOT NULL DEFAULT '0',
  `user_twofactor` int(11) NOT NULL DEFAULT '0',
  `user_twofackey` text NOT NULL,
  `user_referer` text NOT NULL,
  `user_loginnotify` int(11) DEFAULT NULL,
  `user_withdrawnotify` int(11) DEFAULT NULL,
  `user_voicecommands` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 CHECKSUM=1;

--
-- Dumping data for table `users`
--

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `api`
--
ALTER TABLE `api`
  ADD PRIMARY KEY (`api_id`);

--
-- Indexes for table `banlist`
--
ALTER TABLE `banlist`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coins`
--
ALTER TABLE `coins`
  ADD PRIMARY KEY (`coin_id`);

--
-- Indexes for table `emailactivate`
--
ALTER TABLE `emailactivate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `identifications`
--
ALTER TABLE `identifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `referal`
--
ALTER TABLE `referal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sitename`);

--
-- Indexes for table `support`
--
ALTER TABLE `support`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD KEY `id` (`id`);

--
-- Indexes for table `trades`
--
ALTER TABLE `trades`
  ADD PRIMARY KEY (`trade_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`);

--
-- Indexes for table `userguides`
--
ALTER TABLE `userguides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `api`
--
ALTER TABLE `api`
  MODIFY `api_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `banlist`
--
ALTER TABLE `banlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `coins`
--
ALTER TABLE `coins`
  MODIFY `coin_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emailactivate`
--
ALTER TABLE `emailactivate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `identifications`
--
ALTER TABLE `identifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `referal`
--
ALTER TABLE `referal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `support`
--
ALTER TABLE `support`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `trades`
--
ALTER TABLE `trades`
  MODIFY `trade_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `userguides`
--
ALTER TABLE `userguides`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
