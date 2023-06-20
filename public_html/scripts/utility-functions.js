const getBaseUrl = () => {
  const protocol = window.location.protocol.toLowerCase().split(":")[0];
  const host = window.location.host;
  const path = window.location.pathname.split("/").slice(0, -1).join("/");

  return `${protocol}://${host}${path}`;
};

const addTransformationParameters = (imageUrl, transformation) => {
  const urlParts = imageUrl.split("/upload/");

  if (urlParts.length === 2) {
    const transformedUrl =
      urlParts[0] + "/upload/" + transformation + "/" + urlParts[1];

    return transformedUrl;
  }
  return imageUrl;
};

export { getBaseUrl, addTransformationParameters };
