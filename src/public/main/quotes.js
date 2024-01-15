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
fetchJson("https://api.quotable.io/random")
  .then((data) => {
    displayContent(data.content);
    displayAuthor(data.author);
  })
  .catch((error) => {
    console.error("Error:", error);
  });

function displayContent(content) {
  const contentElement = document.getElementById("content");
  contentElement.textContent = content;
}

function displayAuthor(author) {
  const authorElement = document.getElementById("author");
  authorElement.textContent = author;
}
