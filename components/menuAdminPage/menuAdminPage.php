<section class="container_login_screen">
  <p>Menu principal de gerenciamento </p>

  <nav class="menu_admin">
    <ul>
      <li class="menu_admin_li">
        <button>CARROS</button>
        <div>
          <a href="#" target="_self">novo</a>
          <a href="#" target="_self">editar</a>
          <a href="#" target="_self">exclir</a>
          <a href="#" target="_self">marcas</a>
        </div>
      </li>

      <li class="menu_admin_li">
        <button>SLIDER</button>
        <div>
          <a href="#" target="_self">configurar</a>
        </div>
      </li>

      <?php
      if ($_SESSION['access'] == 1) {
      ?>

        <li class="menu_admin_li">
          <button>USUARIOS</button>
          <div>
            <a href="../../loginScreen/newCollaborator.php?num=<?php echo $_GET["num"]; ?>" target="_self">novo</a>
            <a href="#" target="_self">editar</a>
            <a href="#" target="_self">excluir</a>
          </div>
        </li>

      <?php
      };
      ?>

      <li class="menu_admin_li">
        <button>LOGOFF</button>
        <div>
          <a href="#" target="_self">sair</a>
        </div>
      </li>

    </ul>
  </nav>
</section>

<script src="../components/menuAdminPage/script_menuAdminPage.js"></script>