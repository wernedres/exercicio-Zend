<?php

namespace Livraria\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="livros")
 * @ORM\Entity(repositoryClass="Livraria\Entity\LivroRepository")
 */
class Livro {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    protected $id;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $nome;

    /**
     * @ORM\ManyToOne(targetEntity="Livraria\Entity\Categoria", inversedBy="livro")
     * @ORM\JoinColumn(name="categoria_id", referencedColumnName="id")
     * @var int
     */
    protected $categoria;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $autor;

    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $isbn;

   /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $valor;

    public function __construct($options=null) {
        Configurator::configure($this, $options);
    } 
 
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    public function getCategoria() {
        return $this->categoria;
    }

    public function setCategoria($categoria) {
        $this->categoria = $categoria;
        return $this;
    }

    public function getAutor() {
        return $this->autor;
    }

    public function setAutor($autor) {
        $this->autor = $autor;
        return $this;
    }

    public function getIsbn() {
        return $this->isbn;
    }

    public function setIsbn($isbn) {
        $this->isbn = $isbn;
        return $this;
    }

    public function getValor() {
        return $this->valor;
    }

    public function setValor($valor) {
        $this->valor = $valor;
        //return $this;
    }

    public function toArray() {
        return array(
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'autor' => $this->getAutor(),
            'isbn' => $this->getIsbn(),
            'valor' => $this->getValor(),
            'categoria' => $this->getCategoria()
        );
    }

}
