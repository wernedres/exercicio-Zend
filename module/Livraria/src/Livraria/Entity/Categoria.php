<?php


namespace Livraria\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\table (name= "categorias")
 * @ORM\Entity(repositoryClass="Livraria\Entity\CategoriaRepository")
 */

class Categoria {
    /**
 * @ORM\id
 * @ORM\column (type= "integer")
 * @ORM\GeneratedValue
 */
protected $id;

    /** 
 * 
 * @ORM\column (type= "text")
 * @var string
 */

protected $nome;

public function getId() {
    return $this->id;
}

public function setId($id) {
    $this->id = $id;
}

public function getNome() {
    return $this->nome;
}

public function setNome($nome) {
    $this->nome = $nome;
}

public function  __toString(){
    return $this->nome;
}
 
public function toArray(){
    return array('id'=>$this->getId(),'nome'=>$this->getNome());
}

}
