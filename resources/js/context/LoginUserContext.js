import { createContext, useEffect, useState, useContext } from 'react';

const LoginUserContext = createContext();

export const useLoginUserContext = () => {
  return useContext(LoginUserContext);
};

export const LoginUserProvider = ({ children }) => {
  const [loginUser, setLoginUser] = useState({});
  useEffect(() => {
    const getLoginUser = () => {
      axios
        .get('/api/login_user')
        .then((res) => {
          setLoginUser(res.data.login_user);
        })
        .catch((err) => {
          console.log(err);
        });
    };
    getLoginUser();
  }, []);

  return (
    <LoginUserContext.Provider loginUser={loginUser}>
      {children}
    </LoginUserContext.Provider>
  );
};
