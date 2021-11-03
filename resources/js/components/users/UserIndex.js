import React, { useEffect, useState, useRef } from 'react';
import ReactDOM from 'react-dom';
import { useFetchLoginUser } from '../../hooks/useFetchLoginUser';
import { useDebounce } from 'use-debounce';
import UserSearchInputField from './UserSearchInputField';
import UsersSort from './UsersSort';
import UserList from './UserList';
import Loading from '../Loading';
import { findUsers } from '../../functions/findUsers';

const UserIndex = () => {
  const [allUsers, setAllUsers] = useState([]);
  const [sort, setSort] = useState('default');
  const [page, setPage] = useState(1);
  const [hasMore, setHasMore] = useState(false);
  const [loading, setLoading] = useState(false);
  const [value, setValue] = useState('');
  const [searchWord] = useDebounce(value, 500);
  const [maxTextLength, setTextLength] = useState(100);
  const { loginUser } = useFetchLoginUser();

  useEffect(() => {
    const loadUsers = async () => {
      setLoading(true);
      const newUsers = await axios
        .get(`/api/users?sort=${sort}&page=${page}`)
        .then((res) => {
          page < res.users.last_page && setHasMore(true);
          return res.users.data;
        })
        .catch((err) => {
          console.log(err);
        });
      setAllUsers((prev) => [...prev, ...newUsers]);
      setLoading(false);
    };
    // スマホのときは表示する文字数を減らす
    if (window.matchMedia('(max-device-width: 640px)').matches) {
      setTextLength(30);
    }
    loadUsers();
  }, [page, sort]);

  const userList = allUsers.filter((item) => {
    // nameとscreen_nameのどちらかが部分一致するユーザーを探す
    if (item.name) {
      return (
        findUsers(item.name, searchWord) ||
        findUsers(item.screen_name, searchWord)
      );
    }
    // nameがNULLの場合はscreen_nameのみで処理
    return findUsers(item.screen_name, searchWord);
  });

  const handleSearch = (e) => {
    setValue(e.target.value);
  };

  const sortChange = (e) => {
    const selectedSort = document.getElementById('selectSort').value;
    setSort(selectedSort);
    setAllUsers([]);
    setPage(1);
    setHasMore(false);
  };

  const body = document.getElementById('body');
  body.onscroll = () => {
    const scrollAmount = window.scrollY;
    const clientHeight = document.getElementById('usersComponent').clientHeight;

    if (hasMore && clientHeight - scrollAmount < 1000) {
      setPage((prev) => prev + 1);
      setHasMore(false);
    }
    return;
  };

  useEffect(() => {
    if (userList < 10 && hasMore) {
      setPage((prev) => prev + 1);
      setHasMore(false);
    }
  }, [userList]);

  return (
    <>
      <UserSearchInputField value={value} handleSearch={handleSearch} />
      {/* ユーザーの並び替え */}
      <UsersSort sortChange={sortChange} />
      {/* ユーザー一覧 */}
      <div id="usersComponent">
        <UserList
          users={userList}
          loginUser={loginUser}
          maxTextLength={maxTextLength}
        />
      </div>

      {/* Loading Spinner */}
      <div className="text-center">
        {loading && <Loading />}
        {!loading && userList.length === 0 && 'ユーザーは見つかりませんでした'}
      </div>
    </>
  );
};

export default UserIndex;

if (document.getElementById('userIndex')) {
  ReactDOM.render(<UserIndex />, document.getElementById('userIndex'));
}
