// Display an alert in the top-right corner
function showAlert(message) {
	const alertDiv = document.createElement("div");
	alertDiv.className = "position-fixed top-0 end-0 p-3";
	alertDiv.style.zIndex = "1050";
	alertDiv.innerHTML = `
			<div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
				<div class="toast-header">
					<strong class="me-auto">Alert</strong>
					<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
				</div>
				<div class="toast-body">${message}</div>
			</div>
		`;
	document.body.appendChild(alertDiv);

	const toast = new bootstrap.Toast(alertDiv.querySelector(".toast"));
	toast.show();
}

// Function to handle logout
function logout() {
	window.location.href = "index.php?logout=1";
}

// Fetch and display a random quote
async function fetchJson(url) {
	try {
		const response = await fetch(url);
		if (!response.ok) {
			throw new Error(`HTTP error! status: ${response.status}`);
		}
		const json = await response.json();
		return json;
	} catch (error) {
		console.error("Error:", error);
		throw error;
	}
}

// Display quote content
function displayContent(data) {
	const contentElement = document.getElementById("container-quotes");
	contentElement.textContent = data;
}

// Display quote author
function displayAuthor(author) {
	const authorElement = document.getElementById("author-quotes");
	authorElement.textContent = author;
}

// Fetch a random quote and display it
fetchJson("https://api.quotable.io/random")
	.then((data) => {
		displayContent(data.content);
		displayAuthor(data.author);
	})
	.catch((error) => {
		console.error("Error:", error);
	});

document.addEventListener("DOMContentLoaded", function () {
	// Get the element by ID
	var changerElement = document.getElementById("Changer");

	// Check if the element is found
	if (changerElement) {
		// Array of text to be displayed
		var texts = [
			// English
			"Earth 2150",
			// Indonesia
			"Bumi 2150",
			// Jepang
			"アース 2150",
			// Spanyol
			"Tierra 2150",
			// Arab
			"الارض 2150",
			// Korea
			"지구 2150",
			// Rusia
			"Земля 2150",
			// Thailand
			"โลก 2150",
		];

		// Change the innerHTML of the element to the first text in the array
		changerElement.innerHTML = texts[0];

		// Function to change the innerHTML of the element to the next text in the array
		function changeText() {
			// Get the current index
			var index = texts.indexOf(changerElement.innerHTML);

			// Change the innerHTML to the next text in the array
			changerElement.innerHTML = texts[(index + 1) % texts.length];
		}

		// Change the text every 3 seconds
		setInterval(changeText, 500);

		// Call Function
		changeText();

		console.log("Script loaded");
	} else {
		console.error("Element with ID 'Changer' not found.");
	}
});

// DATE
const currentYear = new Date().getFullYear();

// Function to change the theme based on user preference or manual selection
function changeTheme(value) {
	const themeButtons = document.querySelectorAll("[data-bs-theme-value]");

	themeButtons.forEach((button) => {
		button.classList.toggle("active", button.dataset.bsThemeValue === value);
	});

	if (value === "auto") {
		value = window.matchMedia("(prefers-color-scheme: dark)").matches
			? "dark"
			: "light";

		const mediaQueryList = window.matchMedia("(prefers-color-scheme: dark)");
		mediaQueryList.addListener((event) => {
			value = event.matches ? "dark" : "light";
			document.body.setAttribute("data-bs-theme", value);
			updateThemeChangerIcon(value);
		});
	}

	document.body.setAttribute("data-bs-theme", value);
	updateThemeChangerIcon(value);

	const autoButton = document.querySelector(
		"button[data-bs-theme-value='auto']",
	);
	if (autoButton && autoButton.classList.contains("active")) {
		const iconElement = document.querySelector("#bd-theme .icon");
		if (iconElement) {
			iconElement.innerHTML = '<i class="bi bi-circle-half"></i>';
		}
	}
}

// Function to update the icon in the theme changer button based on the theme
function updateThemeChangerIcon(theme) {
	const iconElement = document.querySelector("#bd-theme .icon");
	if (iconElement) {
		switch (theme) {
			case "light":
				iconElement.innerHTML = '<i class="bi bi-sun-fill"></i>';
				break;
			case "dark":
				iconElement.innerHTML = '<i class="bi bi-moon-fill"></i>';
				break;
			case "auto":
				iconElement.innerHTML = '<i class="bi bi-circle"></i>';
				break;
			default:
				break;
		}
	}
}

// Add click event listeners to the theme buttons
document.querySelectorAll("button[data-bs-theme-value]").forEach((button) => {
	button.addEventListener("click", () => {
		changeTheme(button.dataset.bsThemeValue);
	});
});

// Call the changeTheme function with the initial value of 'auto'
changeTheme("auto");
