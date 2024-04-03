<?php

class Usuario {
  public $nome;
  public $email;
  public $senha;
  public $genero;
  public $telefone;
  public $estado;
  public $cidade;

  public function __construct($nome, $email, $senha, $genero, $telefone, $estado, $cidade) {
    $this->nome = $nome;
    $this->email = $email;
    $this->senha = $senha;
    $this->genero = $genero;
    $this->telefone = $telefone;
    $this->estado = $estado;
    $this->cidade = $cidade;
  }

  public function toJson() {
    return json_encode($this);
  }
}
