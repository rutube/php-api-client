<?php

/*
 * This file is part of the Rutube PHP API Client package.
 *
 * (c) Rutube
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

require_once __DIR__ . '/../vendor/autoload.php';

const USER_LOGIN = 'squirrel@squirrel.ru';
const USER_PASS = '998800';
const RUTUBE_HOST = 'rutube.ru';
const TRANSPORT = 'httpful';
const RUTUBE_VIDEO = 'http://pic.rutube.ru/staticfile/27808763b94d4e479e6ed98fe9e54ec2.mp4';
const TEST_ATTEMPTS = 30;
const PAUSE_BETWEEN_ROUNDS = 100000; //100ms