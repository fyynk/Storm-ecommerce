<?php   
// error_reporting(0); // para não mostrar erros na pagina
// ini_set('display_errors', 0);
require_once "config/cfg.php";
if(isset($_SESSION["userid"])) //Está setado o usuário?
{
    $id = $_SESSION["userid"];
    $user = new Usuario();
    $user->loadById($id);
}
elseif (isset($_SESSION["useridEmpresa"])) //Está setado a empresa?
{
    $id = $_SESSION["useridEmpresa"];
    $user = new Empresa();
    $res = $user->loadByIdEmpresa($id);
}
else //Não está setado nem usuário nem empresa?
{
    unset($id);
}
 ?>

<header class="contHeader">
        <a href="index.php">
            <img class="img fl" src="images/views/logotipo.png" title="Voltar a home" alt="Voltar a home" width="100%">
            <h3 class="stormTitulo fl" title="Voltar a home" alt="Voltar a home">STORM</h3>
        </a>

        <div class="menuPerfilEntrar">

            <div class="perfilNome">
                <?php if(!isset($id)): ?>
                <a href="login.php"><p class="nomeUsuario fl">Entrar</p></a>
               <?php elseif(isset($_SESSION["userid"])): 
                echo "<p class='nomeUsuario fl'>" . $user->getApelido() . "</p>"; ?>
            <?php elseif (isset($_SESSION["useridEmpresa"])):
                 echo "<p class='nomeUsuario fl'>" . $res['nm_apelido_empresa'] . "</p>";

                 endif  ?>
             
             <?php if(!isset($id) or isset($_SESSION["userid"])):
            echo "<div class='iconCarrinho'>
                    <a href='carrinho.php'>
                        <img src='images/views/iconeCarrinho.png' width='100%'>
                    </a>
                  </div>";
            endif
        ?>
        <?php if(isset($_SESSION["userid"])):
        echo "<div class='submenu'>
            <a href='perfil.php'>
                <p>Perfil</p>
            </a>
            <a href='sair.php'>
                <p>Sair</p>
            </a>
        </div>";

        elseif (isset($_SESSION["useridEmpresa"])):
            echo "<div class='submenu'>
            <a href='perfilEmpresa.php?dev=".$res['cd_empresa']."'>
                <p>Perfil</p>
            </a>
            <a href='sair.php'>
                <p>Sair</p>
            </a>
        </div>";
        endif
        ?>
                   
            </div>
        </div>

        <div class="menu">
            <ul class="nav fl">
                <a href="catalogo.php"><li>Jogos</li></a>

            </ul>
            <div class="nav2 fl"><a href="sobre.php">
                    <li>Sobre</li>
                </a>
            </div>
        </div>
        <div class="cls"></div>
    </header>