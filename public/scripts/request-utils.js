const sendFetchRequest = (url, data) => {
  const requestOptions = {
    method: "POST",
    headers: {
      "Content-type": "application/x-www-form-urlencoded",
    },
    body: data,
  };

  return fetch(url, requestOptions)
    .then((response) => {
      if (!response.ok) {
        throw new Error(response.statusText);
      }
      return response.json();
    })
    .then((data) => {
      if (data.success) {
        return true;
      } else {
        return false;
      }
    })
    .catch((error) => {
      console.error(error.message);
      throw error;
    });
};

const checkExists = (type, value) => {
  const url = "../core/check_exists.php";
  const data = `type=${encodeURIComponent(type)}&value=${encodeURIComponent(
    value
  )}`;
  return sendFetchRequest(url, data);
};

const validateCredentials = (username, password) => {
  const url = "../core/validate_credentials.php";
  const data = `username=${encodeURIComponent(
    username
  )}&password=${encodeURIComponent(password)}`;
  return sendFetchRequest(url, data);
};

const deletePost = (postId) => {
  const url = "../core/delete_post.php";
  const data = `post_id=${encodeURIComponent(postId)}`;
  return sendFetchRequest(url, data);
};

export { checkExists, validateCredentials, deletePost };
