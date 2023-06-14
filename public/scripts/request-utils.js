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

const createRequestData = (params) => {
  return Object.entries(params)
    .map(
      ([key, value]) =>
        `${encodeURIComponent(key)}=${encodeURIComponent(value)}`
    )
    .join("&");
};

const makeRequest = (url, params) => {
  const data = createRequestData(params);
  return sendFetchRequest(url, data);
};

const checkExists = (type, value) => {
  const url = "../core/check_exists.php";
  const params = { type, value };
  return makeRequest(url, params);
};

const validateCredentials = (username, password) => {
  const url = "../core/validate_credentials.php";
  const params = { username, password };
  return makeRequest(url, params);
};

const deletePost = (postId) => {
  const url = "../core/delete_post.php";
  const params = { post_id: postId };
  return makeRequest(url, params);
};

const addLike = (userId, postId) => {
  const url = "../core/handle_like.php";
  const params = { like_action: "add", user_id: userId, post_id: postId };
  return makeRequest(url, params);
};

const removeLike = (userId, postId) => {
  const url = "../core/handle_like.php";
  const params = { like_action: "remove", user_id: userId, post_id: postId };
  return makeRequest(url, params);
};

export { checkExists, validateCredentials, deletePost, addLike, removeLike };
