const username = '';
const baseUrl = `https://enos.itcollege.ee/~makalm/icd0007/foorum/api.php?username=${username}`;

export default async function main()
{
    console.log(await getAllPosts());

    savePost({ title: "test", content: "test content" }).then(data => console.log(data));
    // deletePost(4591);
    // findPostByTitle("test").then(data => console.log(data));
    deletePostByTitle("test");
}

function getAllPosts()
{
    let url = baseUrl + '&cmd=find-posts'

    return fetch(url).then(response => response.json());
}

async function savePost(post)
{
    let url = baseUrl + '&cmd=save-post'

    const response = await fetch(url,
        {
            method: 'POST',
            headers: { "Content-type": "application/json" },
            body: JSON.stringify(post)
        });

    if (response.status === 400)
        return await response.json();

    return [];
}

function deletePost(id)
{
    let url = baseUrl + `&cmd=delete-post-by-id&id=${id}`

    return fetch(url,
        {
            method: 'POST',
            headers: { "Content-type": "application/json" },
        });
}

function findPostByTitle(title)
{
    let url = baseUrl + `&cmd=find-post-by-title&title=${title}`

    return fetch(url).then(response => response.json());
}

function deletePostByTitle(title)
{
    findPostByTitle(title).then(post => deletePost(parseInt(post.id)));
}