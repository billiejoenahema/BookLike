import { useState } from 'react';

export const useFetchLoginUser = () => {
  const [loginUser, setLoginUser] = useState({});
  const getLoginUser = () => {
    axios
      .get('/api/login_user')
      .then((res) => {
        setLoginUser(res.login_user);
      })
      .catch((err) => {
        console.log(err);
      });
  };
  return { getLoginUser, loginUser };
};
