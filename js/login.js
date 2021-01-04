const loginForm = document.getElementById('login');
const username = document.getElementById('username');
const password = document.getElementById('password');
const passwordMessage = document.getElementById('passwordValidationMessage');

const fetchUsers = async () => {
	try {
		const res = await fetch('./users.json');
		const data = await res.json();
		return data;
	} catch (err) {
		console.error(err);
	}
};

if (loginForm) {
	fetchUsers().then(users => {
		login.addEventListener('submit', e => {
			let validUser = false;
			for (let user in users) {
				const userPassword = users[`${user}`].password;
				if (user === username.value && userPassword === password.value) {
					validUser = true;
					break;
				}
			}
			if (!validUser) {
				e.preventDefault();
				passwordMessage.innerText = 'Incorrect username or password';
				return;
			}
		});
	});
}
