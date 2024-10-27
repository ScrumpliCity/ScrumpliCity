// Self written composable to fetch data since there is no module for it for Nuxt 3 (yet)
export const useApiFetch = async (url: string, options = { headers: {} }) => {
  const baseURL =
    process.env.SCRUMPLICITY_LARAVEL_API_URL || "http://localhost:8000/api"; // Open for better solutions of getting the base URL
  const xsrfToken = useCookie("XSRF-TOKEN");

  return $fetch(`${baseURL}/${url}`, {
    ...options,
    headers: {
      "X-XSRF-TOKEN": xsrfToken.value || "",
    },
    credentials: "include",
  });
};
