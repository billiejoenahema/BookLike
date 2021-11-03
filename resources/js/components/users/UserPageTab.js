import React, { useEffect, useState } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import { useFetchLoginUser } from '../../hooks/useFetchLoginUser';
import ReviewList from '../reviews/ReviewList';
import UserList from './UserList';
import Loading from '../Loading';
import { Tab, Tabs, TabList, TabPanel } from 'react-tabs';
import 'react-tabs/style/react-tabs.css';

const UserPageTab = () => {
  const [userReviews, setUserReviews] = useState([]);
  const [favoriteReviews, setFavoriteReviews] = useState([]);
  const [followingUsers, setFollowingUsers] = useState([]);
  const [followedUsers, setFollowedUsers] = useState([]);
  const [loading, setLoading] = useState(true);
  const [maxTextLength, setTextLength] = useState(100);
  const { loginUser } = useFetchLoginUser();

  const currentPath = window.location.pathname;
  const userId = currentPath.replace(/[^0-9]/g, '');
  const tabStyle = 'text-center small px-0';

  useEffect(() => {
    const loadTab = async () => {
      setLoading(true);
      await axios
        .get(`/api/users/${userId}`)
        .then((res) => {
          console.log(res.user);
          setUserReviews(['1', '2', '3']);
          setFavoriteReviews();
          setFollowingUsers();
          setFollowedUsers();
        })
        .catch((err) => {
          console.log(err);
        });
    };
    // スマホのときは表示する文字数を減らす
    if (window.matchMedia('(max-device-width: 640px)').matches) {
      setTextLength(30);
    }
    loadTab();
    setLoading(false);
  }, []);

  return (
    <>
      <Tabs>
        <TabList>
          <Tab>
            <div className={tabStyle}>
              投稿
              <br />
              {userReviews.length}
            </div>
          </Tab>
          <Tab>
            <div className={tabStyle}>
              いいね
              <br />
              {favoriteReviews.length}
            </div>
          </Tab>
          <Tab>
            <div className={tabStyle}>
              フォロー中
              <br />
              {followingUsers.length}
            </div>
          </Tab>
          <Tab>
            <div className={tabStyle}>
              フォロワー
              <br />
              {followedUsers.length}
            </div>
          </Tab>
        </TabList>
        <TabPanel>
          {userReviews.length !== 0 ? (
            <ReviewList reviews={userReviews} loginUser={loginUser} />
          ) : (
            <div className="pb-5 my-5">投稿はまだありません</div>
          )}
        </TabPanel>
        <TabPanel>
          {favoriteReviews.length !== 0 ? (
            <List reviews={favoriteReviews} loginUser={loginUser} />
          ) : (
            <div className="pb-5 my-5">いいねした投稿はまだありません</div>
          )}
        </TabPanel>
        <TabPanel>
          {followingUsers.length !== 0 ? (
            <UserList
              users={followingUsers}
              loginUser={loginUser}
              maxTextLength={maxTextLength}
            />
          ) : (
            <div className="pb-5 my-5">フォロー中のユーザーはまだいません</div>
          )}
        </TabPanel>
        <TabPanel>
          {followedUsers.length !== 0 ? (
            <UserList
              users={followedUsers}
              loginUser={loginUser}
              maxTextLength={maxTextLength}
            />
          ) : (
            <div className="pb-5 my-5">フォロワーはまだいません</div>
          )}
        </TabPanel>

        {/* Loading Spinner */}
        <div className="text-center">{loading && <Loading />}</div>
      </Tabs>
    </>
  );
};

export default UserPageTab;

if (document.getElementById('userPageTab')) {
  ReactDOM.render(<UserPageTab />, document.getElementById('userPageTab'));
}
