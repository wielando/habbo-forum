/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : habme

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2022-05-01 17:05:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `posts`
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `thread_id` int(11) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('1', '2', '2', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', '1651079722');
INSERT INTO `posts` VALUES ('2', '1', '1', 'Der erste Forenbeitrag!', '1651079722');
INSERT INTO `posts` VALUES ('10', '2', '1', 'ffdsfsdfgdsfgdsfdsf', '1651087662');
INSERT INTO `posts` VALUES ('11', '1', '1', 'asdsadsadsad', '1651167672');

-- ----------------------------
-- Table structure for `rank`
-- ----------------------------
DROP TABLE IF EXISTS `rank`;
CREATE TABLE `rank` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rank_name` varchar(255) DEFAULT NULL,
  `rank_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of rank
-- ----------------------------
INSERT INTO `rank` VALUES ('1', 'Administrator', '2');
INSERT INTO `rank` VALUES ('2', 'Member', '1');
INSERT INTO `rank` VALUES ('3', 'Developer', '3');
INSERT INTO `rank` VALUES ('4', 'Premium', '4');

-- ----------------------------
-- Table structure for `threads`
-- ----------------------------
DROP TABLE IF EXISTS `threads`;
CREATE TABLE `threads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `creator_id` int(11) DEFAULT NULL,
  `thread_status` int(11) DEFAULT NULL,
  `thread_type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of threads
-- ----------------------------
INSERT INTO `threads` VALUES ('1', 'Feedback by me', '1', '2', '1');
INSERT INTO `threads` VALUES ('2', 'Changelog April 9th', '2', '2', '2');

-- ----------------------------
-- Table structure for `thread_status`
-- ----------------------------
DROP TABLE IF EXISTS `thread_status`;
CREATE TABLE `thread_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_name` varchar(255) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of thread_status
-- ----------------------------
INSERT INTO `thread_status` VALUES ('1', 'closed', '2');
INSERT INTO `thread_status` VALUES ('2', 'open', '1');

-- ----------------------------
-- Table structure for `thread_types`
-- ----------------------------
DROP TABLE IF EXISTS `thread_types`;
CREATE TABLE `thread_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(255) DEFAULT NULL,
  `type_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of thread_types
-- ----------------------------
INSERT INTO `thread_types` VALUES ('1', 'community', '1');
INSERT INTO `thread_types` VALUES ('2', 'announcement', '2');
INSERT INTO `thread_types` VALUES ('3', 'update', '3');

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `avatar` text DEFAULT NULL,
  `rank` varchar(11) DEFAULT '',
  `password` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('1', 'Wieland', 'https://i.imgur.com/ARi0uBW.png', '3', null);
INSERT INTO `users` VALUES ('2', 'SampleUser', 'https://www.habbo.de/habbo-imaging/avatarimage?user=Kawu&direction=2&head_direction=3&gesture=sml&action=&size=b', '1,4', null);
INSERT INTO `users` VALUES ('3', 'UserSample', ' https://www.habbo.de/habbo-imaging/avatarimage?user=Kawu&direction=2&head_direction=3&gesture=sml&action=&size=b', '1,4', null);
