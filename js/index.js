async function deleteArticle(id) {
  try {
    await fetch(`delete-article.php?id=${id}`, {
      method: "POST",
    });
    window.location.href = "index.php";
  } catch (error) {
    console.log(error);
  }
}

async function deleteImage(id) {
  try {
    await fetch(`delete-article-image.php?id=${id}`, {
      method: "POST",
    });
    window.location.href = `/admin/article.php?id=${id}`;
  } catch (error) {
    console.log(error);
  }
}

function onPublish(id) {
  fetch(`/admin/publish-article.php`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ id: id }),
  })
    .then((response) => response.text())
    .then((response) => {
      const data = response;
      fetch(`/admin`)
        .then((response) => response.text())
        .then((response) => {
          document.querySelector(`[data-id="${id}"]`).parentElement.innerText =
            "Published";
        });
    })
    .catch((error) => console.log(error));
}
