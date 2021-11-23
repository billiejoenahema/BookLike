import { useState } from 'react';

export const useFetchReview = () => {
  const [review, setReview] = useState({});
  const reviewId = window.location.pathname.includes('/edit')
    ? window.location.pathname.replace('/edit', '')
    : window.location.pathname;

  const getReview = () => {
    console.log('get review!');
    axios
      .get(`/api${reviewId}`)
      .then((res) => {
        setReview(res.data.review);
      })
      .catch((err) => {
        console.log(err);
      });
  };
  return { getReview, review };
};
