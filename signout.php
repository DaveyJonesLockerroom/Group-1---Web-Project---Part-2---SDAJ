<?php
if (!isset($_SESSION['username'])) {
                session_unset();
                session_destroy();
                $_SESSION['alert'] = "You have been logged out.";
                exit();
            }