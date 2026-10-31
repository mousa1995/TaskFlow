type Task = {
  id: number;
  title: string;
  completed: boolean;
};

const tasks: Task[] = [
  {
    id: 1,
    title: "Learn Next.js",
    completed: true,
  },
  {
    id: 2,
    title: "Understand App Router",
    completed: false,
  },
  {
    id: 3,
    title: "Connect Laravel API",
    completed: false,
  },
];

export default function Home() {
  return (
    <main className="mx-auto max-w-xl p-8">
      <h1 className="text-3xl font-bold">TaskFlow</h1>
      <p className="mt-2 text-gray-500">My personal task manager.</p>
      <h2 className="mt-8 text-xl font-semibold">My Tasks</h2>
      <ul className="mt-4 space-y-3">
        {tasks.map((task) => {
          return (
            <li key={task.id} className="rounded-lg border p-4">
              <span>{task.title}</span>
              <span className="ml-3 text-sm text-gray-500">
                {task.completed ? "Completed" : "Pending"}
              </span>
            </li>
          );
        })}
      </ul>
    </main>
  );
}
