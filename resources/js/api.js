import axios from "axios";

let axiosWithApiUrl = axios.create({
    baseURL: "http://localhost:8000/api"
});

export default axiosWithApiUrl;
