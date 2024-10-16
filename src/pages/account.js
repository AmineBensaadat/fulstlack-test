// src/pages/account.js
import { useEffect, useState } from 'react';
import axiosInstance from '../utils/axiosInstance';
import { useRouter } from 'next/router';

const AccountPage = () => {
  const [user, setUser] = useState(null);
  const [loading, setLoading] = useState(true);
  const router = useRouter();

  useEffect(() => {
    const fetchUserData = async () => {
      try {
        const response = await axiosInstance.get('/users/me');
        setUser(response.data);
      } catch (error) {
        console.error('Error fetching user data', error);
        localStorage.removeItem('token');
        router.push('/login');
      } finally {
        setLoading(false);
      }
    };

    fetchUserData();
  }, []);

  if (loading) {
    return <p>Loading...</p>;
  }

  if (!user) {
    return <p>No user data</p>;
  }

  return (
    <div>
      <h1>Account Details</h1>
      <p>Name: {user.name}</p>
      <p>Email: {user.email}</p>
    </div>
  );
};

export default AccountPage;
