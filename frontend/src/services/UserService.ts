// frontend/src/services/UserService.ts
import axios from 'axios';

const API_URL = process.env.NEXT_PUBLIC_API_URL || 'http://localhost:8000/api';

export const getProfile = async (token: string) => {
  const response = await axios.get(`${API_URL}/profile`, {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });
  return response.data;
};

// Change password
export const changePassword = async (token: string, data: {
  current_password: string;
  new_password: string;
  new_password_confirmation: string;
}) => {
  const response = await axios.post(`${API_URL}/user/change-password`, data, {
    headers: {
      Authorization: `Bearer ${token}`,
    },
  });
  return response.data;
};
