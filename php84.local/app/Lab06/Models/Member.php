<?php
// Weight: 10%
//Step 1: Duplicate the contents of Admin.php and modify the class name and return string in getRole() to Member.

namespace Models;

require_once 'User.php';

class Member extends User {
    public function getRole() {
        return "Member";
    }
}