<main>
<div class="cont">
<div class="ui container">

        <div class="two  massive ui buttons">
            <a class="ui button primary" href="<?=base_url()?>doc/">CITAS</a>
            <a class="ui button primary" href="<?=base_url()?>doc/">PACIENTES</a>
        </div>

        <div class="ui center aligned segment">
          <h1>Dra: <?=$_SESSION['name']." ".$_SESSION['lastname']?></h1>
          <h3>Especialista en <?=$_SESSION['speciality'] = 'pedriatria' ?> </h3>
        </div>

    <div class="ui two column stackable grid">
      <div class="column">
        <div class="ui raised segment">
            <div class="image header">
              <p><img  class="ui right spaced image" src="../med/img/icon.png"> Nuevo paciente</p>
            </div>
            <div class="paragraph">
            <p>Un paciente acaba de reservar una cita m&eacutedica en el hospital, para el d&iacutea 20-06-2021 a las 10:00am con la descripci&oacuten de control. </p>
            </div>
        </div>
      </div>
      <div class="column">
        <div class="ui raised segment">
            <div class="image header">
              <p><img  class="ui right spaced image" src="../med/img/icon.png">Nuevo paciente</p>
            </div>
            <div class="paragraph">
            <p>Un paciente acaba de reservar una cita medica en la cl&iacutenica Razeti, para el d&iacutea 29-06-2021 a las 9:00am.  </p>
            </div>
        </div>
      </div>
  </div>
</div>
</div>