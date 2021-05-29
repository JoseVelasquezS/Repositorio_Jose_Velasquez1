<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Proyecto3 - ESP8266 - MPU6050 - UDP - PHP - Three.js</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
		<style>
			body {
				margin: 0px;
				overflow: hidden;
			}
			#inclinacion {
				font-family: arial;
				position: absolute;
				color: #ffffff;
				top:  20px; 
  				left: 20px;
				margin: 0px;
				width: 540px;
				height: 20px;
				border: 0;
			}
		</style>
	</head>

	<body>

		<script src="js/three.js"></script>
		<script src="js/DDSLoader.js"></script>
		<script src="js/MTLLoader.js"></script>
		<script src="js/OBJLoader.js"></script>
		<script src="js/jquery.min.js"></script>

		<div id='contenedor'></div>
		<div id='inclinacion'>-</div>

		<script>

			var contenedor;

			var camera, scene, renderer;

			var windowHalfX = window.innerWidth / 2;
			var windowHalfY = window.innerHeight / 2;

			var axes = new THREE.AxisHelper(50);

			var mesh;

			init();
			animate();

			var inclinacionX;
			var inclinacionY;
			var inclinacionZ;

			function init() {

				contenedor = document.getElementById('contenedor');
	
				camera = new THREE.PerspectiveCamera( 45, window.innerWidth / window.innerHeight, 1, 2000 );

				// scene

				scene = new THREE.Scene();

				var ambient = new THREE.AmbientLight( 0x444444 );
				scene.add( ambient );

				var directionalLight = new THREE.DirectionalLight( 0xffeedd );
				directionalLight.position.set( 0, 0, 1 ).normalize();
				scene.add( directionalLight );
				//scene.add( axes );

				// model

				THREE.Loader.Handlers.add( /\.dds$/i, new THREE.DDSLoader() );

				var mtlLoader = new THREE.MTLLoader();
				mtlLoader.load( '', function( materials ) {

				materials.preload();

				var objLoader = new THREE.OBJLoader();
				objLoader.setMaterials( materials );
				objLoader.load( 'model/a380.obj', function ( object ) {
				object.children[0].geometry.computeFaceNormals();
                var  geometry = object.children[0].geometry;
                THREE.GeometryUtils.center(geometry);
                geometry.dynamic = true;
                var material = new THREE.MeshLambertMaterial({color: 0x0000dd, shading: THREE.FlatShading});
                mesh = new THREE.Mesh(geometry, material);  
                scene.add( mesh )
				});
					
				scene.background = new THREE.Color( 0xaaaaaa );

				});

				renderer = new THREE.WebGLRenderer();
				renderer.setPixelRatio( window.devicePixelRatio );
				renderer.setSize( window.innerWidth, window.innerHeight );
				contenedor.appendChild( renderer.domElement );

				window.addEventListener( 'resize', onWindowResize, false );

			}

			function onWindowResize() {

				windowHalfX = window.innerWidth / 2;
				windowHalfY = window.innerHeight / 2;

				camera.aspect = window.innerWidth / window.innerHeight;
				camera.updateProjectionMatrix();

				renderer.setSize( window.innerWidth, window.innerHeight );

			}

			function animate() {
				requestAnimationFrame( animate );
				render();
			}

			function render() {
				camera.position.x = 0;
				camera.position.y = -250;
				camera.position.z = 80;

				mesh.rotation.x = inclinacionX;
				mesh.rotation.y = inclinacionY;
				mesh.rotation.z = inclinacionZ;

				//mesh.rotation.x = 0.0;
				//mesh.rotation.y = 0.0;
				//mesh.rotation.z = 0.0;

				actualizarInclinacion();

				camera.lookAt( scene.position );
				renderer.render( scene, camera );
			}

			function actualizarInclinacion() {
				$.ajax({
        			url: 'udp.php',
        			type: 'get',
        			success: function(response) { 
        				document.getElementById("inclinacion").textContent = response;
        				separador = ",",
    					arregloInclinaciones = response.split(separador);
						inclinacionX = parseFloat(arregloInclinaciones[1])/-57.295779;
						inclinacionY = parseFloat(arregloInclinaciones[2])/-57.295779;
						inclinacionZ = parseFloat(arregloInclinaciones[3])/57.295779;
        			}
    			});		
			}  

		</script>
	</body>
</html>