import React, { useState, useEffect } from 'react';

export const useFetchLoginUser = () => {
  const [loginUser, setLoginUser] = useState({});
  useEffect(async () => {
    await axios
      .get('/api/login_user')
      .then((res) => {
        setLoginUser(res.data.loginUser);
      })
      .catch((err) => {
        console.log(err);
      });
  }, []);
  return { loginUser };
};
