"use client";

import { useEffect, useState } from "react";
import { useSession } from "next-auth/react";
import { ICart } from "@/interfaces/ICart";
import { fetchCart } from "@/services/cart/get";
import { updateCartQuantity } from "@/services/cart/put";
import { removeFromCart } from "@/services/cart/delete";

export default function CartPage() {
  const { data: session, status } = useSession();
  const [cart, setCart] = useState<ICart>({ items: [], total: 0 });

  useEffect(() => {
    if (status === "authenticated" && session?.user?.id) {
      fetchCart(parseInt(session.user.id), session.user.token)
        .then(setCart)
        .catch((error) => console.error("Erro ao carregar carrinho:", error));
    }
  }, [status, session]);

  const handleUpdateQuantity = async (id_produto: number, delta: number) => {
    if (status === "authenticated" && session?.user?.id && session.user.token) {
      try {
        await updateCartQuantity(
          parseInt(session.user.id),
          id_produto,
          delta,
          session.user.token
        );
        const updatedCart = await fetchCart(
          parseInt(session.user.id),
          session.user.token
        );
        setCart(updatedCart);
      } catch (error) {
        console.error("Erro ao atualizar quantidade:", error);
      }
    }
  };

  const handleRemove = async (id_produto: number) => {
    if (status === "authenticated" && session?.user?.id && session.user.token) {
      try {
        await removeFromCart(
          parseInt(session.user.id),
          id_produto,
          session.user.token
        );
        const updatedCart = await fetchCart(
          parseInt(session.user.id),
          session.user.token
        );
        setCart(updatedCart);
      } catch (error) {
        console.error("Erro ao remover item:", error);
      }
    }
  };

  if (status === "loading") {
    return <div className="container mt-5">Carregando...</div>;
  }

  if (status === "unauthenticated") {
    return <div className="container mt-5">Por favor, faça login.</div>;
  }

  return (
    <div className="container mx-auto mt-10">
      <h2 className="text-2xl font-bold mb-6">Carrinho de Compras</h2>
      {cart.items.length === 0 ? (
        <p className="text-gray-600">O carrinho está vazio.</p>
      ) : (
        <>
          <ul className="space-y-4">
            {cart.items.map((item) => (
              <li
                key={item.product.id_produto}
                className="flex justify-between items-center p-4 bg-white rounded-lg shadow"
              >
                <div>
                  <p className="text-lg font-medium">{item.product.produto}</p>
                  <p className="text-gray-600">Preço: R${item.product.preco}</p>
                  <p className="text-gray-600">Quantidade: {item.quantity}</p>
                </div>
                <div className="space-x-2">
                  <button
                    className="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300"
                    onClick={() =>
                      handleUpdateQuantity(item.product.id_produto, -1)
                    }
                    disabled={item.quantity <= 1}
                  >
                    -
                  </button>
                  <button
                    className="px-2 py-1 bg-gray-200 rounded hover:bg-gray-300"
                    onClick={() =>
                      handleUpdateQuantity(item.product.id_produto, 1)
                    }
                  >
                    +
                  </button>
                  <button
                    className="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600"
                    onClick={() => handleRemove(item.product.id_produto)}
                  >
                    Remover
                  </button>
                </div>
              </li>
            ))}
          </ul>
          <div className="mt-6 text-right">
            <p className="text-xl font-semibold">
              Total: R${cart.total.toFixed(2)}
            </p>
            <button className="mt-4 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
              Finalizar Compra
            </button>
          </div>
        </>
      )}
    </div>
  );
}
