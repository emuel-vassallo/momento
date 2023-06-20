const makeRequest = (file, params) => {
  const apiUrl = `api_endpoint.php?file=${file}&params=${encodeURIComponent(
    JSON.stringify(params)
  )}`;

  return fetch(apiUrl)
    .then((response) => response.json())
    .then((data) => {
      return data.result;
    })
    .catch((error) => {
      console.error(error);
    });
};

export const validateCredentials = (username, password) => {
  const file = "validate_credentials.php";
  const params = { username: username, password: password };
  return makeRequest(file, params);
};

export const checkExists = (type, value) => {
  const file = "check_exists.php";
  const params = { type: type, value: value };
  return makeRequest(file, params);
};

export const deletePost = (postId) => {
  const file = "delete_post.php";
  const params = { postId: postId };
  return makeRequest(file, params);
};

export const addLike = (userId, postId) => {
  const file = "handle_like.php";
  const params = { like_action: "add", user_id: userId, post_id: postId };
  return makeRequest(file, params);
};

export const removeLike = (userId, postId) => {
  const file = "handle_like.php";
  const params = { like_action: "remove", user_id: userId, post_id: postId };
  return makeRequest(file, params);
};

export const getUsersList = () => {
  const file = "get_users_list.php";
  return makeRequest(file, {});
};

export const getUserId = () => {
  const file = "get_user_id.php";
  return makeRequest(file, {});
};

export const getPost = (postId) => {
  const file = "get_post_info.php";
  const params = { post_id: postId };
  return makeRequest(file, params);
};

export const getPostLikes = (postId) => {
  const file = "get_post_likes.php";
  const params = { post_id: postId };
  return makeRequest(file, params);
};