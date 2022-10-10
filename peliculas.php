<?php
include_once 'db.php';
class Peliculas extends DB{
    private $paginaActual;
    private $totalPaginas;
    private $nResultados;
    private $resultadosPorPagina;
    private $indice;

    private $error = false;

    function __construct($nPorPagina){
        parent::__construct();
        $this->resultadosPorPagina = $nPorPagina;
        $this->indice=0;
        $this->paginaActual=1;
        $this->calcularPagina();

    }

    function calcularPagina(){
        $query = $this->connect()->query('select count(*) Total from pelicula'); 
        $this->nResultados = $query->fetch(PDO::FETCH_OBJ)->Total;
        $this->totalPaginas = $this->nResultados / $this->resultadosPorPagina;

        if(isset($_GET['pagina'])){
            //pagina que se un numero
            if(is_numeric($_GET['pagina'])){
                If($_GET['pagina'] >= 1 && $_GET['pagina']<= $this->totalPaginas +1){
                    $this->paginaActual = $_GET['pagina'];
                    $this->indice =($this->paginaActual-1) * ($this->resultadosPorPagina);   
                    foreach($query as $pelicula){
                       include 'vista-pelicula.php'; 
                    }
                }else{
                //confirma error
                echo"No existe esa Pagina ";
                $this -> error= true;
                }
            }else{
                //confirma error
                echo"Error al mostrar Pagina ";
                $this -> error= true;
            }

        }
    }
    
function mostrarPeliculas(){
    if (!$this->error){
        // continuar
        $query= $this->connect()->prepare('SELECT * FROM pelicula LIMIT :pos, :n');
        $query->execute(['pos'=>$this->indice,'n'=>$this->resultadosPorPagina]);

        foreach($query as $pelicula ){
            include 'vista-pelicula.php';

        }
    }else{

    }

}
function mostrarPaginas(){

    $actual= '';
    echo "<ul>";
    for($i=0; $i < $this->totalPaginas; $i++){
        if(($i+1) == $this->paginaActual ){
            $actual= 'class="actual"';
        }else{
            $actual= '';
        }
    echo '<li><a '.$actual.'href="?pagina='.($i + 1).'">'.($i + 1).'</a></li>' ;
}
echo "</ul>";
}

}

?>