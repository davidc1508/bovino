<?php
namespace App\Utils\Enums;

abstract class ETipoGrupo
{
	const Administrador = 1;
	const Operador		= 2;
	const Veterinario	= 3;
	const Aluno			= 4;
	const Consulta		= 5;
	const SuperAdmin	= 9;
}