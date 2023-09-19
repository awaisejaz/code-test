Code to refactor
=================
1) app/Http/Controllers/BookingController.php 
2) app/Repository/BookingRepository.php
-----------------------------------------
1) didn't used try catch in controller i used in first method as a example
2) need to used validations for post request to avoid from some isset() and errors
3) also can set macro for success and error response to make response consistent in whole application.
4) there is mistake in show method in controller
5) in repository refactor and optimize some of methods and format whole code
6) fixed: didn't follow psr1 and psr12 code styling principle
7) in repository in some initial methods i divide code into some small method to make more optimize and reuseable and due to this code looks terrible
8) need to add interface with repository and define all methods there in this way we follow solid principle term interface interface segregation principle and make code more understandable
------------------------------------------

Code to write tests (optional) => completed
=====================
3) App/Helpers/TeHelper.php method willExpireAt
4) App/Repository/UserRepository.php, method createOrUpdate




