<?php
 // EL ($THIS->) SE USA EN LARAVEL, SI LO USA EN PHP NORMAL ES SIN EL ($THIS->), EJ: $variable = Funcion();
public function numerosaletras($xcifra){ #Función Principal
		
		$valor = trim($xcifra); //variable que va a recibir los digitos sin espacios.
		$tamaño = strlen($xcifra);//variable que registra la cantidad de digitos que hay.
		switch ($tamaño) {//caso por tamaño, para tomar una función diferente
			case '4':
				$cadena = $this->cuatro($valor); // se llama a la función 4 (cuatro) que significa 4 Digitos
				break;
			case '3':
				$cadena = $this->tres($valor);// se llama a la función 3 (tres) que significa 3 Digitos
				break;
			case '2':
				$cadena = $this->dos($valor);// se llama a la funcion 2 (dos) que significa 2 Digitos
				break;
			case '1':# aqui se llama directamente a la función donde se asigna las letras a los números.
				$digito = array();//variable en forma de arreglo donde se obtiene el valor en número y letra.
				for ($i=0; $i < $tamaño; $i++) { 
				$digito[$i] = $this->letras($valor[$i]);//se le asigna a $digito el valor obtenido de la función letra.
				}
				$cadena = trim(substr($digito[0], 1));//Se subtrae solamente el nombre del número pasado por paramentros.
				break;
			default:
				$cadena = " No se puede procesar una cifra mayor de 4 digitos";
				break;
		}
		return trim($cadena);//se devuelve el valor obtenido.
	}

	public function cuatro($valor)//función para digitos de 4 Cifra, se puede usar (copiando el codigo) tambien para 8 cifras y mas solo le cambias el Mil por Millones y así sucesivamente 
	{
		$principal = "";//recibe el primer valor en letra mas el termino Mil
		$digito = array();
		$tamaño = strlen($valor);
		for ($i=0; $i < $tamaño; $i++) { 
			$digito[$i] = $this->letras($valor[$i]);
		}
		if (substr($digito[0], 0, 1) == "1") {#si el valor es igual 1 (uno) se coloca solamente Mil,
			$principal = "Mil";
			$axu = $this->tres(trim(substr($valor, 1)));//esta variable llama a la función tres, por si hay mas digitos en $valor
		}elseif (substr($digito[0], 0, 1) == "0"){ //si es igual a cero no se coloca nada en principal y se llama a la función siguiente.
			$principal = " ";
			$axu = $this->tres(trim(substr($valor, 1)));
		}else{//sino se coloca el nombre de numero mas MIL y se llama a la siguiente función
			$principal = trim(substr($digito[0], 1))." Mil";
			$axu = $this->tres(trim(substr($valor, 1)));
		}
		return $principal." ".$axu; // devuelve el valor obtenido en letras de primer digitos y de las siquientes funciones.
	}

	public function tres($valor)//es como la funcion cuatro, se puede copiar para 6 digitos o mas.
	{
		$principal = "";
		$digito = array();
		$tamaño = strlen($valor);
		for ($i=0; $i < $tamaño; $i++) { 
			$digito[$i] = $this->letras($valor[$i]);
		}
		if (substr($digito[0], 0, 1) == "1") {// lo mismo que en la función anterior. 
			if ($valor == 100) {//si valor es igual a cien directamente, se coloca Cien y no se llama a siguientes funciones.
				$principal = "Cien";
				$axu = " ";
			}else{//sino se llama a la funcion dos y se coloca Ciento.
			$principal = "Ciento";
			$axu = $this->dos(trim(substr($valor, 1)));
			}
		}elseif (substr($digito[0], 0, 1) == "0"){// lo mismo que en la función cuatro.
			$principal = " ";
			$axu = $this->dos(trim(substr($valor, 1)));
			// esto es por obios motivos, lo tuve que separa en casos expeficicos porque los nombres en letras son diferentes.
		}elseif (substr($digito[0], 0, 1) == "5") {
			$principal = "Quinientos";
			$axu = $this->dos(trim(substr($valor, 1)));
		}elseif (substr($digito[0], 0, 1) == "7") {
			$principal = "Setecientos";
			$axu = $this->dos(trim(substr($valor, 1)));
		}elseif (substr($digito[0], 0, 1) == "9") {
			$principal = "Novecientos";
			$axu = $this->dos(trim(substr($valor, 1)));
			// Fin, esto es por obios motivos, lo tuve que separa en casos expeficicos porque los nombres en letras son diferentes.
		}else{//sino como todo es normal con los valores que no tienes nombres diferentes
			$principal = trim(substr($digito[0], 1))."cientos";
			$axu = $this->dos(trim(substr($valor, 1)));
		}
		return $principal." ".$axu;
	}

	public function dos($valor)// esta funcion puede servir para mas valores, como las dos de arribas
	{
		$digito = array();
		$tamaño = strlen($valor);
		for ($i=0; $i < $tamaño; $i++) { 
			$digito[$i] = $this->letras($valor[$i]);
		}
		switch (substr($digito[0], 0, 1)) {
			case '1':
				// por como pasa arriba por obios motivos, lo tuve que separa en casos expeficicos porque los nombres en letras son diferentes.
				if ($valor == 10) {
					$principal = "Diez";
				}elseif ($valor == 11) {
					$principal = "Once";
				}elseif ($valor == 12) {
					$principal == "Doce";
				}elseif ($valor == 13) {
					$principal == 'Trece';
				}elseif ($valor == 14) {
					$principal = 'Catorce';
				}elseif ($valor == 15) {
					$principal = 'Quince';
				// Fin, esto es por obios motivos, lo tuve que separa en casos expeficicos porque los nombres en letras son diferentes.
				}else{//sino como todo es normal con los valores que no tienes nombres diferentes
					$principal = "Dieci".strtolower(trim(substr($digito[1], 1)));
				}
				break;
			case '0'://aqui si le asigna a $principal el valor siguiente en el arreglo
				$principal = trim(substr($digito[1], 1));
				break;
			// por como pasa arriba por obios motivos, lo tuve que separa en casos expeficicos porque los nombres en letras son diferentes.
			case '2':
				if ($valor == 20) {
					$principal = "Veinte";
				}else{
					$principal = "Veinti".strtolower(trim(substr($digito[1], 1)));
				}
				break;
			case '3':
				if ($valor == 30) {
					$principal = "Treinta";
				}else{
					$principal = "Treinta y ".strtolower(trim(substr($digito[1], 1)));
				}
				break;
			case '4':
				if ($valor == 40) {
					$principal = "Cuarenta";
				}else{
					$principal = "Cuarenta y ".strtolower(trim(substr($digito[1], 1)));
				}
				break;
			case '5':
				if ($valor == 50) {
					$principal = "Cincuenta";
				}else{
					$principal = "Cincuenta y ".strtolower(trim(substr($digito[1], 1)));
				}
				break;
			case '6':
				if ($valor == 60) {
					$principal = "Sesenta";
				}else{
					$principal = "Sesenta y ".strtolower(trim(substr($digito[1], 1)));
				}
				break;
			case '7':
				if ($valor == 70) {
					$principal = "Setenta";
				}else{
					$principal = "Sesenta y ".strtolower(trim(substr($digito[1], 1)));
				}
				break;
			case '8':
				if ($valor == 80) {
					$principal = "Ochenta";
				}else{
					$principal = "Ochenta y ".strtolower(trim(substr($digito[1], 1)));
				}
				break;
			case '9':
				if ($valor == 90) {
					$principal = "Noventa";
				}else{
					$principal = "Noventa y ".strtolower(trim(substr($digito[1], 1)));
				}
				break;
			// Fin, esto es por obios motivos, lo tuve que separa en casos expeficicos porque los nombres en letras son diferentes.
			default:
				$principal = "Valor no encontrado";
				break;
		}
		return $principal;
	}

	public function letras($digito)// Función donde todo se le asigna el valor en letra y numero. 
	{
		switch ($digito) {
			case '1':
				return "1 Uno";
				break;
			case '2':
				return "2 Dos";
				break;
			case '3':
				return "3 Tres";
				break;
			case '4':
				return "4 Cuatro";
				break;
			case '5':
				return "5 Cinco";
				break;
			case '6':
				return "6 Seis";				
				break;
			case '7':
				return "7 Siete";
				break;
			case '8':
				return "8 Ocho";
				break;
			case '9':
				return "9 Nueve";
				break;
			case '0':
				return "0 Cero";
				break;
			default:
				return "No es Nigún Número";
				break;
		}
	}
?>