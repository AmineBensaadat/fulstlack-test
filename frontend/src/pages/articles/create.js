// src/pages/articles/create.js
import { useState } from 'react';
import axiosInstance from '../../utils/axiosInstance';
import { useRouter } from 'next/router';

const CreateArticlePage = () => {
  const [title, setTitle] = useState('');
  const [content, setContent] = useState('');
  const router = useRouter();

  const handleCreateArticle = async (e) => {
    e.preventDefault();
    try {
      await axiosInstance.post('/articles', { title, content });
      router.push('/articles');
    } catch (error) {
      console.error('Error creating article', error);
    }
  };

  return (
    <div>
      <h1>Create New Article</h1>
      <form onSubmit={handleCreateArticle}>
        <input
          type="text"
          placeholder="Title"
          value={title}
          onChange={(e) => setTitle(e.target.value)}
          required
        />
        <textarea
          placeholder="Content"
          value={content}
          onChange={(e) => setContent(e.target.value)}
          required
        />
        <button type="submit">Create</button>
      </form>
    </div>
  );
};

export default CreateArticlePage;
