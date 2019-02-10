<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Ajutor';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1>Utilizarea aplicației</h1>
    <h3>Plasarea unei comenzi</h3>
    <p>Plasarea unei comenzi în aplicație are următorii pași:</p>
    <ol>
        <li>Te loghezi în aplicație. Dacă nu ai un cont de utilizator, trebuie să-ți faci unul;</li>
        <li>După logare, prima pagină vizibilă este lista ta de comenzi. Pentru început ea va fi goală;</li>
        <li>Pentru plasarea unei comenzi, fă click pe butonul <strong>Comandă nouă</strong>;</li>
        <li>Într-o comandă poți pune mai multe produse (comanda e ca un coș de cumpărături). Pentru a adăuga un produs, alege-l din meniul din dreapta;</li>
        <li>Configurează produsul după cum îl dorești. Nu uita să pui linkul la montaje/imagini dacă e cazul;</li>
        <li>Dacă totul este ok, fă click pe butonul <strong>Adaugă produsul</strong>. Vei fi dus din nou în pagina unde vezi ce produse ai în comanda curentă;</li>
        <li>Aici poți adăuga mai multe produse, dacă dorești. Dacă nu, finalizează plasarea comenzii prin click pe butonul <strong>Plasează comanda</strong>;</li>
        <li>Odată plasată, comanda nu mai poate fi editată, însă comenzile nefinalizate nu pot fi preluate de firmă pentru a putea fi date în lucru.</li>
    </ol>
    <h3>Urmărirea unei comenzi</h3>
    <p>Poți urmări statusul unei comenzi în pagina de comenzi sau deschizând fiecare comandă în parte. Odată ce aceasta va fi livrată, vei putea vedea și numărul de AWB aferent acesteia.</p>
    <h3>Termenul de finalizare al unei comenzi</h3>
    <p><strong>Termenul de preluare</strong> este de o zi lucrătoare de la confirmare. Comenzile <strong>confirmate</strong> de Luni până Joi între orele 8 si 10 vor fi preluate în aceeași zi.</p>
    <p>Comenzile <strong>confirmate</strong> după ora 10 vor fi preluate a doua zi. Pentru comenzile <strong>confirmate</strong> Vineri după ora 10, până Luni, preluarea se va face Luni sau Marți, în funcție de volumul de lucru.</p>
    <p>Termenul de <strong>finalizare</strong> este de 4 zile de la preluare.</p>
    <h3>Livrarea comenzilor</h3>
    <p>Livrarea comenzilor se face prin curier (Fan Courier), cu plata în avans sau ramburs la livrare. Livrarea se face cu valoare declarată (asigurare???) pe cheltuiala beneficiarului.</p>
    <p><strong>Carpatic Studio nu răspunde de defecțiunile survenite în urma transportului.</strong> Ambalarea o facem cu grijă maximă pentru a preîntâmpina orice probleme, dar nu putem garanta modul în care pachetele sunt manipulate de curieri.
        Dacă clientul optează pentru eliminarea asigurării de transport, o face pe propria răspundere, Carpatic Studio nu-și asumă nici o răspundere și nici nu va înlocui produsele defecte decât pe cheltuiala clientului.</p>
</div>
