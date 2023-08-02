<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Cambiar Navegación</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		<a class="navbar-brand" href="<? echo base_url(); ?>">Guardias y Horarios</a>
		<a href="<? echo base_url(); ?>" class="navbar-left" data-toggle="tooltip" title="Ir a Inicio">
			<img class="img-responsive" style="max-height:50px" src="<? echo base_url(); ?>/assets/img/logo.png">
		</a>
		<a href="<? echo base_url(); ?>inicio/tvSala" id="tvsala" class="navbar-left" data-toggle="tooltip" title="Proyección TV">
			<img class="img-responsive" style="max-height:50px" src="<? echo base_url(); ?>/assets/img/television.png">
		</a>
	</div>
	<!-- /.navbar-header -->
	<ul class="nav navbar-top-links navbar-right">
		<? if (isset($_SESSION['logueado'])) {
			if ($_SESSION['roll'] == "admin") {
		?>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="<? echo base_url(); ?>login">
						<i class="fa fa-user fa-fw"></i>
						<i class="fa fa-caret-down"></i>
					</a>
					<ul class="dropdown-menu dropdown-user">
						<li>
							<a href="<? echo base_url(); ?>login/ver_perfil">
								<i class="fa fa-user fa-fw"></i> Perfil Usuario</a>
						</li>

						<li class="divider"></li>
						<li>
							<a href="<? echo base_url(); ?>login/logout">
								<i class="fa fa-sign-out fa-fw"></i> Desconectar</a>
						</li>
					</ul>
				<?
				//}
			} else {
				?>
				<li>
					<a href="<? echo base_url(); ?>login/logout">
						<i class="fa fa-sign-out fa-fw"></i> Desconectar</a>
				</li>
	</ul>
<?

			}
		} else {
?>
<form action="<? echo base_url(); ?>login/login" id="frmlogin" class="navbar-form navbar-right" role="form" method="POST">
	<div class="input-group">
		<span class="input-group-addon">
			<i class="glyphicon glyphicon-user"></i>
		</span>
		<input id="usuario" type="text" class="form-control" name="usuario" maxlength="20" value="" placeholder="Usuario">
	</div>

	<div class="input-group">
		<span class="input-group-addon">
			<i class="glyphicon glyphicon-lock"></i>
		</span>
		<input id="clave" type="password" maxlength="20" class="form-control" name="clave" value="" placeholder="Clave">
	</div>

	<button type="submit" class="btn btn-primary">Login</button>
</form>
<?
		}
?>
<!-- /.dropdown-user -->
</li>
<!-- /.dropdown -->
</ul>
<!-- /.navbar-top-links -->

<div class="navbar-default sidebar" role="navigation">
	<div class="sidebar-nav navbar-collapse">
		<ul class="nav" id="side-menu">
			<li>
				<a href="index.html">
					<i class="fa fa-dashboard fa-fw"></i> Zona Profesores
					<span class="fa arrow"></span>
				</a>
				<ul class="nav nav-second-level">
					<li>
						<a href="<? echo base_url() ?>turnos">Ver Turnos de Guardia</a>
					</li>
					<li>
						<a href="<? echo base_url() ?>horarios">Ver Horarios de Profesores</a>
					</li>
					<li id="menuoGrupos">
						<a href="<? echo base_url() ?>horarios/mostrar_grupo">Ver Horarios de Grupos</a>
					</li>
					<li id="menuoAulas">
						<a href="<? echo base_url() ?>horarios/mostrar_aula">Ver Horarios de Aulas</a>
					</li>
				</ul>
			</li>
			<? if (isset($_SESSION['logueado'])) {
				if ($_SESSION['roll'] == "admin") {
			?>
					<li>
						<a href="#">
							<i class="fa fa-graduation-cap fa-fw"></i> Zona Jefatura
							<span class="fa arrow"></span>
						</a>
						<ul class="nav nav-second-level">
							<li>
								<a href="<? echo base_url() ?>faltas">Mant.Faltas de Profesores</a>
							</li>
							<li>
								<a href="<? echo base_url() ?>horarios/mostrarman">Mant.Horarios Profesores</a>
							</li>
							<li>
								<a href="<? echo base_url() ?>faltas/informe_faltas">Informe de Faltas</a>
							</li>
							<li>
								<a href="<? echo base_url() ?>faltas/calendario">Calendario Faltas</a>
							</li>
							<li>
								<a href="<? echo base_url() ?>turnos/confirmar_correr_turnos">Correr Turnos de Guardia</a>
							</li>
							<li>
								<a href="<? echo base_url() ?>turnos/crear_turnos">Crear Turnos desde Horarios</a>
							</li>
						</ul>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-bar-chart-o fa-fw"></i> Mant. de Tablas Auxiliares
							<span class="fa arrow"></span>
						</a>
						<ul class="nav nav-second-level">

							<!-- <li>
							<a href="<? echo base_url() ?>horarios/mostrarman_g">Horarios Grupos</a>
						</li> -->
							<li>
								<a href="<? echo base_url() ?>profman">Profesores</a>
							</li>
							<li>
								<a href="<? echo base_url() ?>turman">Turnos de Guardia</a>
							</li>
							<li>
								<a href="<? echo base_url() ?>mantablas/registro">Registro de Guardias</a>
							</li>
							<li>
								<a href="<? echo base_url() ?>mantablas/grupos">Grupos</a>
							</li>
							<li>
								<a href="<? echo base_url() ?>mantablas/cursos">Cursos</a>
							</li>
							<li>
								<a href="<? echo base_url() ?>mantablas/aulas">Aulas</a>
							</li>
							<li>
								<a href="<? echo base_url() ?>mantablas/materias">Materias</a>
							</li>
							<li>
								<a href="<? echo base_url() ?>mantablas/causas">Causas Faltas</a>
							</li>
							<li>
								<a href="<? echo base_url() ?>mantablas/tramos">Tramos Horarios</a>
							</li>
							<li>
								<a href="<? echo base_url() ?>mantablas/actividades">Actividades</a>
							</li>
							<li>
								<a href="<? echo base_url() ?>mantablas/usuarios">Usuarios</a>
							</li>
							<li>
								<a href="<? echo base_url() ?>horman">Horarios(Antiguo)</a>
							</li>
					</li>
		</ul>
		<!-- /.nav-second-level -->
		</li>
		<li>
			<a href="#">
				<i class="fa fa-file fa-fw"></i> Generar Horarios a PDF
				<span class="fa arrow"></span>
			</a>
			<ul class="nav nav-second-level">
				<li>
					<a href="<? echo base_url() ?>imppdf">Ver PDFs Generados</a>
				</li>
				<li>
					<a href="<? echo base_url() ?>imppdf/impHprofes" onclick="mostrarTrabajando('Generando PDFs');">Individuales Profesores</a>
				</li>
				<li>
					<a href="<? echo base_url() ?>imppdf/impHgrupos" onclick="mostrarTrabajando('Generando PDFs');">Individuales Grupos</a>
				</li>
				<li>
					<a href="<? echo base_url() ?>imppdf/impHaulas" onclick="mostrarTrabajando('Generando PDFs');">Individuales Aulas</a>
				</li>
				<li>
					<a href="<? echo base_url() ?>imppdf/impHprofesTodo" onclick="mostrarTrabajando('Generando PDFs');">Profesores (Todos)</a>
				</li>
				<li>
					<a href="<? echo base_url() ?>imppdf/impHgruposTodo" onclick="mostrarTrabajando('Generando PDFs');">Grupos (Todos)</a>
				</li>
				<li>
					<a href="<? echo base_url() ?>imppdf/impHaulasTodo" onclick="mostrarTrabajando('Generando PDFs');">Aulas (Todos)</a>
				</li>
			</ul>
		</li>
		<li>
			<a href="#">
				<i class="fa fa-download fa-fw"></i> Importar Datos<span class="fa arrow"></span>
			</a>
			<ul class="nav nav-second-level">
				<li>
					<a href="<? echo base_url() ?>ficheros/subirTAuxiliares">Tablas Auxiliares</a>
				</li>
				<li>
					<a href="<? echo base_url() ?>ficheros/subirHorarios">Horarios</a>
				</li>
			</ul>
		</li>
<?
				}
			}
?>
	</div>
	<!-- /.sidebar-collapse -->
</div>
<!-- /.navbar-static-side -->
</nav>