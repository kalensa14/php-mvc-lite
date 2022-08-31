<?php

include view_path('/includes/header.php') ?>


    <main class="form-signin">
        <div class="row g-5">
            <form>
                <h1 class="h3 mb-3 fw-normal">Registration</h1>

                <div class="form-floating">
                    <input type="text" class="form-control" id="floatingUsername"
                           name="username" placeholder="John Smith">
                    <label for="floatingUsername">Username</label>
                </div>

                <div class="form-floating">
                    <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                           name="email">
                    <label for="floatingInput">Email address</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                           name="password">
                    <label for="floatingPassword">Password</label>
                </div>
                <div class="form-floating">
                    <input type="password" class="form-control" id="floatingPasswordRepeat" placeholder="Password"
                           name="password_repeat">
                    <label for="floatingPassword">Password</label>
                </div>

                <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
            </form>
        </div>
    </main>


<?php
include view_path('/includes/footer.php');