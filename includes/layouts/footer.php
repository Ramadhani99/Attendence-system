<footer class="navbar-default navbar-fixed-bottom">
  <div class="container-fluid">
     <
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Copyright &copy; Your Website 2016
                    &nbsp
<?php
                $Today = date('y:m:d');
                $new = date('l, F d, Y', strtotime($Today));
                echo $new;
                ?>
                </p>
                </div>
            </div>
        </div>
    
  </div>
</footer>