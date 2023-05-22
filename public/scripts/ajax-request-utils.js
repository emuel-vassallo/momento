export { checkExists, validateCredentials };

const sendAjaxRequest = (url, data) => {
  return new Promise((resolve, reject) => {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", url);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xhr.onload = () => {
      if (xhr.status === 200) {
        const response = xhr.responseText;
        if (response === "invalid") {
          resolve(true);
          return;
        }

        if (response === "valid") {
          resolve(false);
          return;
        }

        reject(new Error("Invalid response from server"));
      } else {
        reject(new Error(xhr.statusText));
      }
    };

    xhr.onerror = () => {
      reject(new Error(xhr.statusText));
    };

    xhr.send(data);
  });
};

const checkExists = (type, value) => {
  const url = "../core/check_exists.php";
  const data = `type=${encodeURIComponent(type)}&value=${encodeURIComponent(
    value
  )}`;
  return sendAjaxRequest(url, data);
};

const validateCredentials = (username, password) => {
  const url = "../core/validate_credentials.php";
  const data = `username=${encodeURIComponent(
    username
  )}&password=${encodeURIComponent(password)}`;
  return sendAjaxRequest(url, data);
};
