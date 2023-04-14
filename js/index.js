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
    window.location.href = "index.php";
  } catch (error) {
    console.log(error);
  }
}
