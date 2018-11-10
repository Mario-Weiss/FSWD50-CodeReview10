<nav class="navbar navbar-expand-md navbar-light bg-light">
  <a class="navbar-brand d-md-none" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class=<?php if ($page=='index'){echo'"active ';}else{echo '"';} ?>nav-item">
        <a class="nav-link" href="index.php">Media <span class="sr-only">(current)</span></a>
      </li>
      <li class=<?php if ($page=='author'){echo'"active ';}else{echo '"';} ?>nav-item">
        <a class="nav-link" href="author.php">Author</a>
      </li>
      <li class=<?php if ($page=='publisher'){echo'"active ';}else{echo '"';} ?>nav-item">
        <a class="nav-link" href="publisher.php">Publisher</a>
      </li>
      <li class=<?php if ($page=='edit'){echo'"active ';}else{echo '"';} ?>nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          insert new
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="edit.php?media=1">insert media</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="edit.php?author=1">insert author</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="edit.php?publisher=1">insert publisher</a>
        </div>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> -->
    </ul>
    <form class="form-inline my-2 my-lg-0" method="post" <?php echo 'action="'.$page.'.php">'; ?>
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"  name="search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>