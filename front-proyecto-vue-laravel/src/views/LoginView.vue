<!-- Single File Component con Composition API-->
<template>
	<!-- <div>
		{{ usuario }}
		<h1>Login</h1>
		<label for="email">Digita el correo: </label>
		<input type="email" id="email" v-model="usuario.email"><br>
		<span>{{ errors.email }}</span>
		<label for="password">Digita la contraseña: </label>
		<input type="password" id="password" v-model="usuario.password"><br>
		<span>{{ errors.password }}</span>
		<input type="button" value="Enviar" v-on:click="funIngresar()">

		{{ errors }}
	</div> -->

	<div class="surface-ground flex align-items-center justify-content-center min-h-screen min-w-screen overflow-hidden">
        <div class="flex flex-column align-items-center justify-content-center">
            <!-- <img :src="logoUrl" alt="Sakai logo" class="mb-5 w-6rem flex-shrink-0" /> -->
            <div style="border-radius: 56px; padding: 0.3rem; background: linear-gradient(180deg, var(--primary-color) 10%, rgba(33, 150, 243, 0) 30%)">
                <div class="w-full surface-card py-8 px-5 sm:px-8" style="border-radius: 53px">
                    <div class="text-center mb-5">
                        <!-- <img src="/demo/images/login/avatar.png" alt="Image" height="50" class="mb-3" /> -->
                        <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAYkAAACACAMAAADJe2XzAAAA/FBMVEX///83gP/6ORP8vQY4sTcvff/8uQB4o//8uwAdqxxil/8tfP8oev/u9+76IgAgd//6MgAieP/6JgBpm/9HiP8XdP/6GACb05ssriuGrP/6NQiUtf+5zv/o7/8mrSTW4v/+3dnv9P/9xsD+79L+5OGvx//P3f/4+v/h6v/8lIiDqv+owv/8m5D92Y//9vX8h3n7dWRYkf/8q6L9z8r9tKyauf/+5LD+6Lz7ZFD90XD9yVLE5MTE1f9OjP//9ub//ff9sKj903n9y8b7a1j6TzX8xkL8i376RCX936D6Ujn7ZlL+8938xkP9vrf8mI76SCr8wiv9zWL914b+5bUNeDuWAAASF0lEQVR4nO1dCXfaSBL2sQIGKbpA7BrsBYzBGF8cxna8YDt24mMS55r//19W4lRVVx8CRPIC35t5M8+IplufqrtubWyoolzc7TbS/c0A/XSycNyrK393jUWhXk1qnmMYmrY5hKbpumF5rW7tV09tlVDb0SxjTAGEZjhesverJ7gaqBd0SydZmLJhNYq/eprLx7t/A8T9c72WZwhpGEL3+isnGO/++k8I/433x3azFr0pEYJhZVeMi3d//SuMOH+qlrUUaRjC6q+ULrU0JsoZT1UeJnLh7cQ3n98Oy2KiGpmHAIa2Okrtcpg4TEfbmKbwCjFN6bfDUpiocawHJbFoHcYzqd8Ny2Ci683Mgw9tcy+WWf1uWAITSdHOFHg5fGgCodGsldCh4meixTPlAs+G0c80dgqFnWRL93geEP+wWAWTO3YmsrRrQ3eszHGtHLrwsFhNGhZFm5FZ/LR+P8TNBEmELw0NWj0tFnQHS8ZqEBE3E32CCM3K7gq+0utDl8iKEBEzE2lis3GkDqVa31o9IuJlYsdhzwdDJA9j7Br6qhERKxO7rB1hZdTstMOkt2JExMlEnSFC81QEYojd4LRYISLiZILdmSJZy3tZfZWIiJGJHaw2Ga2II6TTC5zOb4/YmCjivUlfqfsaHbExgbcmY02EGHExcYwUWK2/sKH/UMTExCH2v2orEmWYHTExUUDGtbcSju25EA8Th+i4do4XNPAfjHiYQCKhRdVfVxHxMIFOCW814p/zIRYmqlBx0lcmP2MexMJEHwZ7nMWM+ocjDiaQ689YH9cqiIOJLvQ4WQsZ9I9HHExk4Smx5OTWs85b+8TH/VvpbPZRbiuXL6c+Xq4qdzMPUu9Vuz6qNRWNJRoTZ6W39tenp6P2RYe/yj24OS3TqOucXLum6bq2bbuua+bs5v1B9FEqp58SAVI+gv9uv7+8jTxIsdvyLMfQDf8fxzKSuzInQwQm9s+fc8NV2sEqt8736et2gea0PIdT6ck17fwWgO3mntuRRKPyPqBgG8Dn4/tLFNEodzdR9pbmeI3RI7nb2JmiOvmOKhOdZs5Fy7Rd87xEXNoAx8Syzuv915y9RSHv5prUNElcbicQC1MyPqgKxl6SLJzSvcwgv6tg6RM4ycm31Jh4ezbJZdq5a3aR8PeXk0rZ+WjmqQmOp/motEld8XgYkfFeSS52PF4doeYFIhB2QGjRmOh84y/Tzp2jq5HPSVeZ/Jw4a+YEPAyneSId5faLiIchFy/SUXq6qJ7TSs7DxLl4mbbdAZcX4TGRpIZcLB5cel8CcL9JxOJSxkOAxCeJWDQkefF6f6MQoioKEwdb0mXm2uEv7II9cgnHxNecnAcf+dybaJT3CTkPA7GoCAY57Esra7VsMnSUR2BiXyb3AczwDtUFk3FiL89qukpEBE+MYIf6pEZEIBaX3EH2RMUH07sf/n9lJu7Vnje3Of1KA8zGitsNe61MhP/EPHEGufuusDNNqOAdFntMcrWcFVUmFInwqZhKRQZMx1O4mZl0BLSgLnatcESEqDiiZxCFCC4VZT16DZsqE/uqRPhrnJwVLfBTKqpTVtfUYYH8ZvWtaYjcPTWBT5GI8Km4okbZnKGYUJGJA5qIvI0t2cEaxxoU9DplVZiIMnegApyYxPR8+990A6eHcJoh/CDOiIGbY+jzoKj4zI6SJrTXoD2P4/j/cuuq1JjYYldiu7mt6+bjq79O/KE7cirAX1KJm0ZiIhx26rCPim9rtoeev4P9oy3CHnUZ38clS0QicfPyeaCv3l79JMy91DaziC6TF685xs6wZVW51uX0yVBj4pyRfN+M2x8t5KCNzT3776UwETZQmPtsm1/Bje48Mqqf3US/fssQkUqcAquhcsNwkfiARmHTsS3YBKaepHoDKDFRwg+cbZ7AZT5Dqsy3pTAxzSU8x0zkmswDX3rFz1PuAV7xhbnLP5kZVr5juvD+lEW3WWPrROpZdo9SYuIjeprMR2aZT3Cbdtn7quSJjcbEZER8jOXNB2r0E3zZFvj4Ct3jVIo03T7gy76Dj1HknlPP32DqoVWYeEOHITSkR2iDi9yBjtiHv0UtCyESE1MdACmw+TzHnYE1QPc+/Ol2Ct1hjjsDnyZQf0JPu8Px8XSZ1EgFJp6hSGCZHgFuELlAatLQsqOnBDAbE2j3zNvcMAQ+2O3QZ0gk0KMexqXgymPIhMF1tuHcSAUmHqBI5DhRIahf2YENm4SWXZnzxRBmY6IJRSIncPBdoF005IBCpkRK4OA7hVSEHVBQgRUdjvA5VWHiEazT5XpsmoxQFMC0LIX2AjMxcQYfdPNC9AtwlvnryQef+XeXBTzbU+8nH/TgKeEIAqUodVvOBFxnaOoApXMUJwsYq0IPoEJl3Uwn9gXQiWzODMeACtRUfk7hzcW6KQTSdxOTD9CGLFwyvD1yJuA6acl/I+KV/hZcAw+ISmaH1NsB5j7SYqHQivamAPdgPe5E+4DndUISfIC8Tc5sGBuTqYsRZQKs08ZhOR9nX13Gyg42ic7GnhVlXgGSGTGSlB8ZCC1jrjEAvE0kCD7lqVPJIHfw8rEEwRQKSxIHAAqvnAlwxLEPnG+70j7QgDS4E3rzl7CAZ27k7eiAh9wsycY4AfM1R3+F+pBMJHyrIiwUE5cH1FGkenv4/kiZKIWZyL/Ckc7alD9nwINrt7FbXKkngRjF8NxHHsCTMBPIWKMAzcAxc/DO3khHqZDMgfXqXdkgkWJ2YFt1gU3nn9LUtrQ1cL4NdN1j3pk0K8AhZwy9OUAbsjlhhzCAfeSONC0QlxAE4yaATAw1rTI4JuS5LOHNTMoEMNjMkCOZOqWHj6XrHo02seKitydQ2T1aKbBjXNrsBHiiqIM3lnB1Y/wA1A0jRlBFMaRjhHMkpUxch9eZGxuvB0fkKR2szPwY0uehHelM09xmBNByR0FAuNkoZPm9hcV8dMLDEzghGSHAS/gbqaGrEBzYmkJbhSgyAe730LG3sf83P8kO5gLCJEBNJVgkApD+kS52BlQKUzJCAOroA3adwNExBXCOjGw7kBpvKFTttKYHhZQJMOuPwcrbed4pbW7hxNMa3J5kap0M4Jkb2ScHYIbfFEY5gB6Pwd/AAZz6oTAK/MbwiAe+JJWsomQEJsKy7xvYQVIsSYN/SjeJcCTyrcxZ7wgs2JEqJlTuSECvwdAJWCGecDGgFH0a/A0cYyo+hdAXZEzAWX975YhD3rVPyB0apjzNKRRQNRl5FCETElcHsabhjkvtNWLcEkw0lsYEEc4eisM1L6mujEKJc50UYBseHzozyATYnRYjE18Gf1ueTNDiYD4JXD0ZVPIotXYEAMf/2G6idn0x4MnyPPgbteuLQZ4T4MSO8ZygxMH8JnRCMy2F5ijIhnbiuEAJPis5hXGAe2S0nyHnqsIo/xBSdBxmQsXj2Y/AhCixTqkyBAdEZt6fDh16HKjFKlRHtOX2hEJ1xE/gHhl6DKE9odA8KaRaSpl45ddLsEorBZx0wo8nSpAEm9PUSgT5Dq4wC3wI6B4ZRb6gl1sYJhriC+EegT4Febi4HoWJJkco7NyjgmMhQBJlxFmzZe/3IKPTZQJ/jNwpjmJF7igYfEM84iLcUX4nGJ6QBymrUSpZ2pT5kHfdr8qVnFh92ozQFnMKGOsIG7Aw9CM3sh/g9aN1nJJebj7+Ibcz4I2Rt8bIRPHFPrBM2LlXhT1gCtz0bNOL/i6uMkrnCqUnlGB+j3RqUMrH2R1X1DMuANicJu4R2HtS5gIEIiRlAquxjGtJAX2cfOhFdQWWUfa1EdZLwLMy8MiIAMMT0yAkDMLJ9NjPdIgPJhTIAjJAGZTH7OCRnf94L5kjgT0mUzTiO4fq+H0UVti/DjOtTF4W0AhQJNzJ1TfwzJb4xW84JzxaqXgQ6B6VMnECDzjCtyRHlck9dKL0x+xhJmHjNJiQlc8Lx0K5Z9NjBYZPJe5YnKU2+QCGTw2hHduNmNsBpVkWndyi7bwkk5Grq78VrYCJwDYJVO+orIcp8nnetShxRqQ+3aEktem1yPks6o+BdgqFzDO4Pbm8ArUBHm3zmrQxcAJ1MMukUgivyOZV4/WdoEx1gdWPMmhzpelHH+DtpauFhkDpgolQywKUsSVoBJqNnAN4gXK1BPvwkRsYfNSNKBOlNLqCZVEmag2Yr2Gtgj9FVAIGstRw9QRff7pBIhEOZ8A8G4FLARceqWQoI9uOn9o1qrAixYKt7/Bh6MdCudij2i0Qzd6PkKqd40jFI76uFP70Byqf4EkFrsVLgC4eaLZall4hUwGmwgQ27twSO/DgfoxPTlIsmO7iw9vqcV5T5KOXptpekE8ZNnpM6qw4eEbPFDLImZIiopBlY6OCkvtx4mYPaSeaQSxwj31pk1IlSx75nsgS/7O/Q7eDEosa3T1Bt/RGj0kjr1cz9KvUNHLnvcD1jrbNzPGIKe/KoUmeMlRsY7G4YxsYYHdhmrGeknh5XaK8S4mJfbxOk62duoAdMyixoKUiIMPwtEyh2qsVfdR2j3daFu+NdppO5/6zxdgu8E8eHLHRRvMej8IUY6cS3y9DN7ryni15ZPawMqOy614j5IIqH+tU/alaxeMjXoWdOw8bFgftPOMUIY6TuqBgXDMMw3Esy3Ecg3+ZpnGKMM5Yp0zezX18unjodPbb51Sqov3IjMKWPAY1wJ9+XlYqlauX9ymiDjjBxveIVwHpltao9or14m63RXZ8Uq4CZuuZbdNtnrx1/HXeP30jsgzIHaxMVPpFgb7JrYYhyoCD6iJ3AMqfTFpG/7BUBPV2/HJs0gJskN21jMFzxn17pSITTPXpgAzbHbbaI0IYLse8Er75VAbhq1yU21mMQMeUfiq3TxmRRMaUWqLGTvMxsfEWbZ38cpLZ3lM+gNcQEEF3KeADKrBTKLYUGhGR4LSh47xYdBFMRFunLUix2Ouzr7ZTmqk0rIGLfAXI85P7I1CRSnH7AUanQr2rkGIXqwCuOOvomNsdTwCrJS+YvFCdom0L4lyMLsslYlsQ7k4rPG8GVZcjZ2KjrbpOUxbBPCTbJQjnrFZ7UVJpPuc/Ka/C+PuVSvM5X2sSxzB2pC9ltwrdGbvPdTgJgBB5hY6HG/V0FC50r6CY73/2KN9E5RO8VWh7lpLWWPToTikTeMezd2Q8e5Wv082XlO5ZMcPRqxkY3o5CJfcYb7a4z1PefFWIwL9IxCKVuJG3jD3MCB63QXeqObqUXkjEws4JneYAewVD3qNNtzbFTkIWJ2yboxAPz5KQ3gh3PwVc+Ja3QhqOjxqng9D42OvOzsTG2RGndGLIg1pb3Al6SYtv6vhmt8V7jbkYnOq/vJ17VeMhwN0pZVIPjO4bNR4GK+wT6onmaMNjLywT+lRHf/fXf8PgjX12wrFZo7SKnqJW6HsW49/QfIvU6xdmzizvnLuw0Vk+aCt+ErHH+9UP1Fg8NWgrHq3He33HAE403V/YWP0I59GGkzf/ByAYfL9psut8jdY+PYTDYnUnrXnewOnkWJZnaemdam3OorxSu7mVM81B9znT/Hh+MUOr/Y2NysuP7Un3ucSXn1ezvPigeJzRBqvz17bZ2J1mBoez/FVKkCh0RusMkLOvj/ZnpWGKcr1Yq9WKxXqE81mGg1Ln4aEzz9snAtx+rvi4nf3tEz4O9/zVFVF6djjzbK7GxmelTqdTmulZWyNAOOitUm6xRlwIG38qrX7WiAnhVHGl9ldrxASQB7J+wVxsKGZkSjho27F+aXhMqGYtYWBrA6WKixM315gR9R0rcORY4uoEkCoe/zshVhC91tjDoQmvA24QlTcRrBEJx5tTv6YuqikErSVU2q2sEQkG8PVb/N0fZn+t7bqFA5WycaunyvC69RthFw/kBPdoqUDvMZrV/beGALsoo8vJEE5lfNHawI4DuL5Tc7CXtdhCROjiTK41ZgNb3+kYhal7b6/aZ0KqC+jfugYBtr5z07CsVrJQKDTSBpEFzwjNGgsC7o8x3KQ03dDJLPh5O8GtwUc/UpKjsz6uY8MhUWrLhbcOEcWIQ/UM5RmamKwRBS3FDMc1EbFD9nrsATRjvTXFj54l3aEs8g1raywawgxlH8b8fdbXUESRNaenPCiXIqyxCNQyHpWCbURPgV9jXpSP04MU7BEfg9zrbGF9UP8aFHcLyXTw7tFsK1mYO/c6Ov4PHJjHsj4WyKcAAAAASUVORK5CYII=" alt="Image" height="50" class="mb-3" />
						
                        <div class="text-900 text-3xl font-medium mb-3">Bienvenido</div>
                        <span class="text-600 font-medium">Ingresar para continuar</span>
                    </div>

                    <div>
                        <label for="email1" class="block text-900 text-xl font-medium mb-2">Correo</label>
                        <InputText id="email1" type="text" placeholder="Dirección de Correo" class="w-full md:w-30rem mb-5" style="padding: 1rem" v-model="usuario.email" />
						<span>{{ errors.email }}</span>

                        <label for="password1" class="block text-900 font-medium text-xl mb-2">Contraseña</label>
                        <Password id="password1" v-model="usuario.password" placeholder="Contraseña" :toggleMask="true" class="w-full mb-3" inputClass="w-full" inputStyle="padding:1rem"></Password>
						<span>{{ errors.password }}</span>

                        <div class="flex align-items-center justify-content-between mb-5 gap-5">
                            <div class="flex align-items-center">
                                <Checkbox v-model="checked" id="rememberme1" binary class="mr-2"></Checkbox>
                                <label for="rememberme1">Recordarme</label>
                            </div>
                            <a class="font-medium no-underline ml-2 text-right cursor-pointer" style="color: var(--primary-color)">¿Olvidaste tu contraseña?</a>
                        </div>
                        <Button label="Ingresar" class="w-full p-3 text-xl" v-on:click="funIngresar()"></Button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
	import { ref } from "vue"; // Referencia las variables para reaccionar
	import axios from "axios";
	import { useRouter } from "vue-router";
	import authService from "./../services/auth.service";
	// Para Pinia
	import { useAuthStore } from "@/stores/auth";
	const auth = useAuthStore();

	// Se crean las variables
	// const correo = ref("micorreo@mail.com"); // Se relaciona con el v-model del campo correspondiente
	// const clave = ref("miclave"); // Se relaciona con el v-model del campo correspondiente
	const usuario = ref({ email: "", password: "" }); // Reemplaza las 2 de arriba
	const errors = ref({});
	const router = useRouter();

	// Se crean los métodos
	async function funIngresar() {
		// Con Interceptor
		try {
			const { data } = await authService.loginConLaravel(usuario.value);
			errors.value = {} // Limpiamos el objeto error
			// Tomo el valor de email para Pinia
			auth.setUsuario(data.usuario.name);
			localStorage.setItem("access_token", data.access_token);
			localStorage.setItem("auth", data.usuario.name);
			router.push("/about"); // Redireccionamos

		} catch (error) {
			//console.log(error.response.data);
			errors.value = error.response.data.errors;
		}



		// Con Axios
		//axios.post("http://127.0.0.1:8000/api/v1/auth/login", {email: correo.value, password: clave.value}).then(  // esto se reemplaza por lo de abajo

		// axios.post("http://127.0.0.1:8000/api/v1/auth/login", usuario.value).then(
		//     (res) => {
		//         console.log(res);
		//     }
		// )
	}

</script>


<style></style>